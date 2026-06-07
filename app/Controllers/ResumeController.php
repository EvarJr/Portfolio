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
use App\Models\AboutModel;

/**
 * ResumeController — app/Controllers/ResumeController.php
 * Supports ?format=classic (default), modern, ats
 */
class ResumeController extends BaseController
{
    private const FORMATS = [
        'classic' => 'index',
        'modern'  => 'index_modern',
        'ats'     => 'index_ats',
    ];

    public function index(): string
    {
        $format = $this->request->getGet('format') ?? 'classic';
        if (!array_key_exists($format, self::FORMATS)) {
            $format = 'classic';
        }

        $header = (new HeaderModel())->getHeader();
        $about  = (new AboutModel())->first() ?? [];

        $photoUrl      = '';
        $photoPosition = '50% 50%';
        if (!empty($header['show_photo']) && !empty($about['photo'])) {
            $photoUrl      = base_url($about['photo']);
            $photoPosition = $about['photo_position'] ?? '50% 50%';
        }

        $data = [
            'header'         => $header,
            'summary'        => (new SummaryModel())->getSummary(),
            'history'        => (new HistoryModel())->getAllWithBullets(),
            'skills'         => (new PersonalSkillModel())->getAllOrdered(),
            'tech'           => (new TechStackModel())->getAllOrdered(),
            'languages'      => (new LanguageModel())->getAllOrdered(),
            'education'      => (new EducationModel())->getAllWithBullets(),
            'certifications' => (new CertificationModel())->getAllOrdered(),
            'isLoggedIn'     => $this->isLoggedIn(),
            'currentFormat'  => $format,
            'photoUrl'       => $photoUrl,
            'photoPosition'  => $photoPosition,
        ];

        return view('resume/' . self::FORMATS[$format], $data);
    }
}