<?php
namespace App\Models;
use CodeIgniter\Model;

class PortfolioStackModel extends Model
{
    protected $table         = 'portfolio_tech_stacks';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name','image_url','project_ids','sort_order'];
    protected $useTimestamps = false;

    public function getAllOrdered(): array
    {
        return $this->orderBy('sort_order','ASC')->orderBy('id','ASC')->findAll();
    }

    public static function encodeProjects(array $ids): string
    {
        return json_encode(array_values(array_filter(array_map('intval', $ids))));
    }

    public static function decodeProjects(string $raw): array
    {
        return json_decode($raw ?: '[]', true) ?: [];
    }
}