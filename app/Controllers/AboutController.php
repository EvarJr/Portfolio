<?php
namespace App\Controllers;
use App\Models\AboutModel;
use App\Models\AboutServiceModel;
use App\Models\AboutTestimonialModel;
use App\Models\CertificationModel;
use App\Models\EducationModel;
use App\Models\HeaderModel;
use App\Models\HistoryModel;
use App\Models\LanguageModel;
use App\Models\PersonalSkillModel;
use App\Models\ProjectModel;
use App\Models\ResumeCollectionModel;
use App\Models\ThesisIsoModel;
use App\Models\ThesisPhaseModel;
use App\Models\SummaryModel;
use App\Models\TechStackModel;
use App\Models\PortfolioStackModel;

class AboutController extends BaseController
{
    private function resumeData(): array
    {
        $rid = (new ResumeCollectionModel())->getActiveId();
        return [
            'header'         => (new HeaderModel())->getHeader($rid),
            'summary'        => (new SummaryModel())->getSummary($rid),
            'history'        => (new HistoryModel())->getAllWithBullets($rid),
            'skills'         => (new PersonalSkillModel())->getAllOrdered($rid),
            'tech'           => (new TechStackModel())->getAllOrdered($rid),
            'languages'      => (new LanguageModel())->getAllOrdered($rid),
            'education'      => (new EducationModel())->getAllWithBullets($rid),
            'certifications' => (new CertificationModel())->getAllOrdered($rid),
        ];
    }

    private function aboutData(): array
    {
        // Inside aboutData() or index(), add:
        $portfolioStackModel = new PortfolioStackModel();
        $techStacks          = $portfolioStackModel->getAllOrdered();

        
        $projects      = (new ProjectModel())->getFeatured();
        $phaseModel    = new ThesisPhaseModel();
        $isoModel      = new ThesisIsoModel();

        // Load phases + ISO scores for ALL projects (keyed by project_id)
        $allPhases = [];
        $allIso    = [];
        foreach ($projects as $p) {
            $pid = (int)$p['id'];
            $phases = $phaseModel->getForProject($pid);
            $scores = $isoModel->getForProject($pid);
            if (!empty($phases)) $allPhases[$pid] = $phases;
            if (!empty($scores)) $allIso[$pid]    = $scores;
        }

        // Keep backwards-compatible single thesis vars for any legacy code
        $thesisProject = null;
        foreach ($projects as $p) {
            if ($p['category'] === 'thesis') { $thesisProject = $p; break; }
        }
        $thesisId     = $thesisProject ? (int)$thesisProject['id'] : 0;
        $thesisPhases = $allPhases[$thesisId] ?? [];
        $isoScores    = $allIso[$thesisId]    ?? [];

        return [
            'about'           => (new AboutModel())->getAbout(),
            'services'        => (new AboutServiceModel())->getAllOrdered(),
            'testimonials'    => (new AboutTestimonialModel())->getAllOrdered(),
            'projects'        => $projects,
            'thesisPhases'    => $thesisPhases,
            'isoScores'       => $isoScores,
            'allThesisPhases' => $allPhases,
            'allIsoScores'    => $allIso,
            'isLoggedIn'      => $this->isLoggedIn(),
            'techStacks'  => $techStacks,
        ];
    }

    public function index(): string
    {
        return view('about/index', array_merge($this->aboutData(), $this->resumeData()));
    }

    public function resume(): string
    {
        return view('about/resume_print', array_merge($this->aboutData(), $this->resumeData()));
    }
}