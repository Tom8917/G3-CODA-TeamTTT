<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;

    protected $allowedFields = [
        'full_name',
        'email',
        'password_hash',
        'role_id',
        'created_at',
        'updated_at',
    ];

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }
}
