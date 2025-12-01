<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CarModel;
use CodeIgniter\HTTP\RedirectResponse;

class Cars extends BaseController
{
    public function getIndex()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $carModel = new CarModel();
        $cars     = $carModel->orderBy('brand', 'ASC')->orderBy('name', 'ASC')->findAll();

        return $this->view('admin/cars/index', [
            'title'       => 'Voitures – Admin LES3T',
            'currentUser' => $currentUser,
            'cars'        => $cars,
        ], true);
    }

    public function getNew()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        return $this->view('admin/cars/form', [
            'title'       => 'Nouvelle voiture',
            'currentUser' => $currentUser,
            'car'         => null,
        ], true);
    }

    public function postCreate()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $name       = trim((string) $this->request->getPost('name'));
        $brand      = trim((string) $this->request->getPost('brand'));
        $dailyPrice = (float) $this->request->getPost('daily_price');
        $imageUrl   = trim((string) $this->request->getPost('image_url'));
        $isActive   = (int) $this->request->getPost('is_active', FILTER_VALIDATE_INT) === 1 ? 1 : 0;

        if ($name === '' || $brand === '' || $dailyPrice <= 0) {
            return redirect()->back()->withInput()->with('error', 'Veuillez remplir tous les champs obligatoires.');
        }

        $carModel = new CarModel();
        $carModel->insert([
            'name'        => $name,
            'brand'       => $brand,
            'daily_price' => $dailyPrice,
            'image_url'   => $imageUrl,
            'is_active'   => $isActive,
        ]);

        return redirect()->to(base_url('admin/cars'))
            ->with('success', 'Voiture ajoutée avec succès.');
    }

    public function getEdit(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $carModel = new CarModel();
        $car      = $carModel->find($id);

        if (! $car) {
            return redirect()->to(base_url('admin/cars'))
                ->with('error', 'Voiture introuvable.');
        }

        return $this->view('admin/cars/form', [
            'title'       => 'Éditer une voiture',
            'currentUser' => $currentUser,
            'car'         => $car,
        ], true);
    }

    public function postUpdate(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $carModel = new CarModel();
        $car      = $carModel->find($id);

        if (! $car) {
            return redirect()->to(base_url('admin/cars'))
                ->with('error', 'Voiture introuvable.');
        }

        $name       = trim((string) $this->request->getPost('name'));
        $brand      = trim((string) $this->request->getPost('brand'));
        $dailyPrice = (float) $this->request->getPost('daily_price');
        $imageUrl   = trim((string) $this->request->getPost('image_url'));
        $isActive   = (int) $this->request->getPost('is_active', FILTER_VALIDATE_INT) === 1 ? 1 : 0;

        if ($name === '' || $brand === '' || $dailyPrice <= 0) {
            return redirect()->back()->withInput()->with('error', 'Veuillez remplir tous les champs obligatoires.');
        }

        $carModel->update($id, [
            'name'        => $name,
            'brand'       => $brand,
            'daily_price' => $dailyPrice,
            'image_url'   => $imageUrl,
            'is_active'   => $isActive,
        ]);

        return redirect()->to(base_url('admin/cars'))
            ->with('success', 'Voiture mise à jour avec succès.');
    }

    public function postDelete(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $carModel = new CarModel();
        $car      = $carModel->find($id);

        if (! $car) {
            return redirect()->to(base_url('admin/cars'))
                ->with('error', 'Voiture introuvable.');
        }

        $carModel->delete($id);

        return redirect()->to(base_url('admin/cars'))
            ->with('success', 'Voiture supprimée avec succès.');
    }
}
