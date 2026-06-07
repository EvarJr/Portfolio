<?php
namespace App\Models;
use CodeIgniter\Model;
class AboutModel extends Model {
    protected $table='resume_about'; protected $primaryKey='id'; protected $useTimestamps=false;
    protected $allowedFields = [
    'tagline', 'bio', 'photo', 'photo_position',
    'cv_label', 'btn_contact_label', 'btn_contact_email',
    'github', 'linkedin_url', 'twitter', 'facebook',
    'nav_about', 'nav_resume', 'nav_contact',
];
    public function getAbout(): array {
    return $this->find(1) ?? [
        'id'               => 1,
        'tagline'          => 'Developer',
        'bio'              => '',
        'photo'            => '',
        'photo_position'   => '50% 50%',
        'cv_label'         => 'Download CV',
        'btn_contact_label'=> 'Contact',
        'btn_contact_email'=> '',
        'github'           => '',
        'linkedin_url'     => '',
        'twitter'          => '',
        'facebook'         => '',
        'nav_about'        => 'About Me',
        'nav_resume'       => 'Resume',
        'nav_contact'      => 'Contact',
    ];
}
    public function updateAbout(array $data): bool { if($this->find(1)) return $this->update(1,$data); $data['id']=1; return(bool)$this->insert($data); }
}
