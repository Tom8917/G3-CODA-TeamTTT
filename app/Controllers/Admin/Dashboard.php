<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CarModel;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    public function getIndex()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $userModel = new UserModel();
        $carModel  = new CarModel();

        $stats = [
            'usersCount' => $userModel->countAllResults(),
            'carsCount'  => $carModel->countAllResults(),
        ];

        return $this->view('admin/dashboard/index', [
            'title'       => 'Tableau de bord – Admin LES3T',
            'currentUser' => $currentUser,
            'stats'       => $stats,
        ], true);
    }
}
