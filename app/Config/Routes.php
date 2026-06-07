<?php

use CodeIgniter\Router\RouteCollection;

/**
 * =============================================================
 * app/Config/Routes.php  — REPLACE your entire file with this
 * =============================================================
 * Uses CI4's native $routes object.
 * The old $router->get() calls do NOT work in real CodeIgniter 4.
 * =============================================================
 */

/** @var RouteCollection $routes */

// ── PUBLIC ────────────────────────────────────────────────────
$routes->get('/',             'AboutController::index');
$routes->get('about',         'AboutController::index');
$routes->get('resume',        'AboutController::resume');
$routes->get('resume/plain',  'ResumeController::index');
$routes->get('resume/download', 'ResumeDownloadController::index');

// ── AUTH ──────────────────────────────────────────────────────
$routes->get('login',         'AuthController::index');
$routes->post('login',        'AuthController::login');
$routes->get('logout',        'AuthController::logout');

// ── ADMIN (protected by AuthFilter) ──────────────────────────
$routes->get('admin',             'AdminController::index', ['filter' => 'auth']);
$routes->get('admin/dashboard',   'AdminController::index', ['filter' => 'auth']);

// ── API: About Me ─────────────────────────────────────────────
$routes->post('api/about/update',        'Api\AboutController::update',       ['filter' => 'auth']);
$routes->post('api/about/upload-photo',  'Api\AboutController::uploadPhoto',  ['filter' => 'auth']);

// ── API: Services ─────────────────────────────────────────────
$routes->post('api/about-service/add',             'Api\AboutServiceController::add',        ['filter' => 'auth']);
$routes->post('api/about-service/update/(:num)',   'Api\AboutServiceController::update/$1',  ['filter' => 'auth']);
$routes->post('api/about-service/delete/(:num)',   'Api\AboutServiceController::delete/$1',  ['filter' => 'auth']);

// ── API: Testimonials ─────────────────────────────────────────
$routes->post('api/about-testimonial/add',             'Api\AboutTestimonialController::add',        ['filter' => 'auth']);
$routes->post('api/about-testimonial/update/(:num)',   'Api\AboutTestimonialController::update/$1',  ['filter' => 'auth']);
$routes->post('api/about-testimonial/delete/(:num)',   'Api\AboutTestimonialController::delete/$1',  ['filter' => 'auth']);

// ── API: Header ───────────────────────────────────────────────
$routes->post('api/header/update', 'Api\HeaderController::update', ['filter' => 'auth']);

// ── API: Summary ──────────────────────────────────────────────
$routes->post('api/summary/update', 'Api\SummaryController::update', ['filter' => 'auth']);

// ── API: Work History ─────────────────────────────────────────
$routes->post('api/history/add',            'Api\HistoryController::add',        ['filter' => 'auth']);
$routes->post('api/history/update/(:num)',  'Api\HistoryController::update/$1',  ['filter' => 'auth']);
$routes->post('api/history/delete/(:num)',  'Api\HistoryController::delete/$1',  ['filter' => 'auth']);

// ── API: History Bullets ──────────────────────────────────────
$routes->post('api/history-bullet/add',            'Api\HistoryBulletController::add',        ['filter' => 'auth']);
$routes->post('api/history-bullet/update/(:num)',  'Api\HistoryBulletController::update/$1',  ['filter' => 'auth']);
$routes->post('api/history-bullet/delete/(:num)',  'Api\HistoryBulletController::delete/$1',  ['filter' => 'auth']);

// ── API: Skills ───────────────────────────────────────────────
$routes->post('api/skill/add',            'Api\SkillController::add',        ['filter' => 'auth']);
$routes->post('api/skill/update/(:num)',  'Api\SkillController::update/$1',  ['filter' => 'auth']);
$routes->post('api/skill/delete/(:num)',  'Api\SkillController::delete/$1',  ['filter' => 'auth']);

// ── API: Tech Stack ───────────────────────────────────────────
$routes->post('api/tech/add',            'Api\TechController::add',        ['filter' => 'auth']);
$routes->post('api/tech/update/(:num)',  'Api\TechController::update/$1',  ['filter' => 'auth']);
$routes->post('api/tech/delete/(:num)',  'Api\TechController::delete/$1',  ['filter' => 'auth']);

// ── API: Languages ────────────────────────────────────────────
$routes->post('api/language/add',            'Api\LanguageController::add',        ['filter' => 'auth']);
$routes->post('api/language/update/(:num)',  'Api\LanguageController::update/$1',  ['filter' => 'auth']);
$routes->post('api/language/delete/(:num)',  'Api\LanguageController::delete/$1',  ['filter' => 'auth']);

// ── API: Education ────────────────────────────────────────────
$routes->post('api/education/add',            'Api\EducationController::add',        ['filter' => 'auth']);
$routes->post('api/education/update/(:num)',  'Api\EducationController::update/$1',  ['filter' => 'auth']);
$routes->post('api/education/delete/(:num)',  'Api\EducationController::delete/$1',  ['filter' => 'auth']);

// ── API: Education Bullets ────────────────────────────────────
$routes->post('api/education-bullet/add',            'Api\EducationBulletController::add',        ['filter' => 'auth']);
$routes->post('api/education-bullet/update/(:num)',  'Api\EducationBulletController::update/$1',  ['filter' => 'auth']);
$routes->post('api/education-bullet/delete/(:num)',  'Api\EducationBulletController::delete/$1',  ['filter' => 'auth']);

// ── API: Certifications ───────────────────────────────────────
$routes->post('api/certification/add',            'Api\CertificationController::add',        ['filter' => 'auth']);
$routes->post('api/certification/update/(:num)',  'Api\CertificationController::update/$1',  ['filter' => 'auth']);
$routes->post('api/certification/delete/(:num)',  'Api\CertificationController::delete/$1',  ['filter' => 'auth']);

// ── API: Account ──────────────────────────────────────────────
$routes->post('api/account/change-password', 'Api\AccountController::changePassword', ['filter' => 'auth']);

// Resume Collection API
$routes->post('api/resume-collection/create',            'Api\ResumeCollectionController::create',        ['filter'=>'auth']);
$routes->post('api/resume-collection/clone/(:num)',      'Api\ResumeCollectionController::clone/$1',      ['filter'=>'auth']);
$routes->post('api/resume-collection/rename/(:num)',     'Api\ResumeCollectionController::rename/$1',     ['filter'=>'auth']);
$routes->post('api/resume-collection/set-active/(:num)', 'Api\ResumeCollectionController::setActive/$1',  ['filter'=>'auth']);
$routes->post('api/resume-collection/delete/(:num)',     'Api\ResumeCollectionController::delete/$1',     ['filter'=>'auth']);


// Projects admin page
$routes->get('admin/projects', 'ProjectsAdminController::index', ['filter'=>'auth']);

// Projects API
$routes->post('api/project/add',              'Api\ProjectController::add',         ['filter'=>'auth']);
$routes->post('api/project/update/(:num)',    'Api\ProjectController::update/$1',   ['filter'=>'auth']);
$routes->post('api/project/delete/(:num)',    'Api\ProjectController::delete/$1',   ['filter'=>'auth']);
$routes->post('api/project/reorder',          'Api\ProjectController::reorder',     ['filter'=>'auth']);


// Thesis content API
$routes->post('api/thesis/phase/add',              'Api\ThesisContentController::addPhase',      ['filter'=>'auth']);
$routes->post('api/thesis/phase/update/(:num)',    'Api\ThesisContentController::updatePhase/$1',['filter'=>'auth']);
$routes->post('api/thesis/phase/delete/(:num)',    'Api\ThesisContentController::deletePhase/$1',['filter'=>'auth']);
$routes->post('api/thesis/phase/reorder',          'Api\ThesisContentController::reorderPhases', ['filter'=>'auth']);
$routes->post('api/thesis/iso/update',             'Api\ThesisContentController::updateIso',     ['filter'=>'auth']);

$routes->get('uploads/projects/(:any)',          'ProjectMediaController::serve/$1');
$routes->post('api/project/upload-media/(:num)', 'Api\ProjectController::uploadMedia/$1', ['filter'=>'auth']);
$routes->post('api/project/delete-media/(:num)', 'Api\ProjectController::deleteMedia/$1', ['filter'=>'auth']);

