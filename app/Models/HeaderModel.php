<?php
namespace App\Models;

use CodeIgniter\Model;

class HeaderModel extends Model
{
    protected $table         = 'resume_header';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'name', 'position', 'email', 'phone',
        'location', 'linkedin', 'portfolio_url', 'show_photo',
    ];

    /**
     * Always returns a single header row (the latest).
     * Adjust if your existing model has different logic.
     */
    public function getHeader(): array
    {
        $row = $this->orderBy('id', 'DESC')->first();
        return $row ?: [];
    }

    /**
     * Update the most recent header row, or insert one if none exists.
     */
    public function updateHeader(array $data): bool
    {
        $existing = $this->orderBy('id', 'DESC')->first();
        if ($existing) {
            return $this->update($existing['id'], $data);
        }
        return (bool) $this->insert($data);
    }
}