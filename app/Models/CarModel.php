<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table      = 'cars';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'name',
        'brand',
        'daily_price',
        'image_url',
        'is_active',
    ];

    /**
     * Retourne les voitures actives pour le front.
     *
     * @return array
     */
    public function findActive(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('brand', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
