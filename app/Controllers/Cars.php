<?php

namespace App\Controllers;

use App\Models\CarModel;

class Cars extends BaseController
{
    public function getIndex()
    {
        $currentUser = session('user');
        $carModel    = new CarModel();
        $cars        = $carModel->findActive();

        return $this->view('cars/index', [
            'title'       => 'LES3T – Nos voitures de luxe',
            'currentUser' => $currentUser,
            'cars'        => $cars,
        ], false); // false = template front
    }
}
