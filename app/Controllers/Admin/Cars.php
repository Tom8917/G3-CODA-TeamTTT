<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CarModel;
use CodeIgniter\HTTP\RedirectResponse;

class Cars extends BaseController
{
    /**
     * Liste des catégories possibles :
     * on centralise ici pour réutiliser partout (admin + front).
     */
    private array $categories = [
        'suv'       => 'SUV',
        'berline'   => 'Berline',
        'sport'     => 'Sport',
        'cabriolet' => 'Cabriolet',
        'autre'     => 'Autre',
    ];

    public function getIndex()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $carModel = new CarModel();
        $cars     = $carModel
            ->orderBy('brand', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->view('admin/cars/index', [
            'title'      => 'Voitures – Admin LES3T',
            'currentUser'=> $currentUser,
            'cars'       => $cars,
            'categories' => $this->categories,
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
            'categories'  => $this->categories,
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

        $imagesPath = FCPATH . 'images/';
        $localImages = [];

        if (is_dir($imagesPath)) {
            foreach (scandir($imagesPath) as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp'])) {
                    $localImages[] = 'images/' . $file;
                }
            }
        }

        $category   = (string) $this->request->getPost('category');
        if (! array_key_exists($category, $this->categories)) {
            $category = 'autre';
        }

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
            'category'    => $category,
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

        $imagesPath = FCPATH . 'images/';
        $localImages = [];

        if (is_dir($imagesPath)) {
            foreach (scandir($imagesPath) as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp'])) {
                    $localImages[] = 'images/' . $file;
                }
            }
        }

        return $this->view('admin/cars/form', [
            'title'       => 'Éditer une voiture',
            'currentUser' => $currentUser,
            'car'         => $car,
            'categories'  => $this->categories,
            'localImages'  => $localImages,
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

        $category   = (string) $this->request->getPost('category');
        if (! array_key_exists($category, $this->categories)) {
            $category = 'autre';
        }

        if ($name === '' || $brand === '' || $dailyPrice <= 0) {
            return redirect()->back()->withInput()->with('error', 'Veuillez remplir tous les champs obligatoires.');
        }

        $carModel->update($id, [
            'name'        => $name,
            'brand'       => $brand,
            'daily_price' => $dailyPrice,
            'image_url'   => $imageUrl,
            'is_active'   => $isActive,
            'category'    => $category,
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
