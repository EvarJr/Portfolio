<?php

namespace App\Controllers;

use App\Models\HeaderModel;
use App\Models\SummaryModel;
use App\Models\HistoryModel;
use App\Models\PersonalSkillModel;
use App\Models\TechStackModel;
use App\Models\LanguageModel;
use App\Models\EducationModel;
use App\Models\CertificationModel;

/**
 * ResumeDownloadController
 * Serves the resume as a downloadable DOCX file.
 * Route: GET /resume/download
 */
class ResumeDownloadController extends BaseController
{
    private const GENERATOR = __DIR__ . '/../../resume_docx/generate.js';
    private const NODE      = 'C:\\Program Files\\nodejs\\node.exe';

    public function index()
    {
        // ── 1. Gather resume data ─────────────────────────────
        $header         = (new HeaderModel())->getHeader();
        $summary        = (new SummaryModel())->getSummary();
        $history        = (new HistoryModel())->getAllWithBullets();
        $skills         = (new PersonalSkillModel())->getAllOrdered();
        $tech           = (new TechStackModel())->getAllOrdered();
        $languages      = (new LanguageModel())->getAllOrdered();
        $education      = (new EducationModel())->getAllWithBullets();
        $certifications = (new CertificationModel())->getAllOrdered();

        $data = compact(
            'header', 'summary', 'history', 'skills',
            'tech', 'languages', 'education', 'certifications'
        );

        // ── 2. Write JSON to a temp INPUT file ────────────────
        // Avoids shell quoting issues with complex JSON on Windows
        $tmpJson = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'resume_in_' . uniqid() . '.json';
        $tmpDocx = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'resume_out_' . uniqid() . '.docx';

        file_put_contents($tmpJson, json_encode($data, JSON_UNESCAPED_UNICODE));

        // ── 3. Build command using file paths (no JSON in args) 
        $node      = '"' . self::NODE . '"';
        $generator = '"' . self::GENERATOR . '"';
        $inFile    = '"' . $tmpJson . '"';
        $outFile   = '"' . $tmpDocx . '"';

        $cmd    = "{$node} {$generator} {$inFile} {$outFile} 2>&1";
        $output = shell_exec($cmd);

        // ── 4. Clean up input temp file ───────────────────────
        @unlink($tmpJson);

        // ── 5. Check success ──────────────────────────────────
        if (!file_exists($tmpDocx) || filesize($tmpDocx) === 0) {
            log_message('error', 'ResumeDownloadController failed. CMD: ' . $cmd . ' | Output: ' . $output);
            return $this->response
                ->setStatusCode(500)
                ->setBody('Resume generation failed. Please try again. Error: ' . htmlspecialchars($output ?? 'unknown'));
        }

        // ── 6. Build filename ─────────────────────────────────
        $name     = $header['name'] ?? 'Resume';
        $safeName = preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $name);
        $safeName = trim(str_replace(' ', '_', $safeName));
        $filename = $safeName . '_Resume.docx';

        // ── 7. Stream to browser ──────────────────────────────
        $docxContent = file_get_contents($tmpDocx);
        @unlink($tmpDocx);

        return $this->response
            ->setStatusCode(200)
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setHeader('Content-Length', strlen($docxContent))
            ->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->setBody($docxContent);
    }
}