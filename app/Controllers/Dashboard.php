<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function getIndex()
    {
        return $this->view('dashboard/index', [
            'title' => 'LES3T – Location de voitures de luxe',
        ], false); // false = FRONT
    }
}
