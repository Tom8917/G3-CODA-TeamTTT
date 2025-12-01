<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class Auth extends BaseController
{
    public function getLogin()
    {
        return $this->view('auth/login', [
            'title' => 'Connexion - LES3T',
        ], false); // FRONT
    }


    public function postLogin()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password_hash'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Identifiants invalides.');
        }

        $sessionData = [
            'id'         => $user['id'],
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
            'role_id'    => $user['role_id'],
            'isLoggedIn' => true,
        ];

        session()->set('user', $sessionData);

        if ((int) $user['role_id'] === 1) {
            return redirect()->to(base_url('admin'))
                ->with('success', 'Connexion administrateur réussie.');
        }

        return redirect()->to(base_url('/'))
            ->with('success', 'Connexion réussie.');
    }

    public function getRegister()
    {
        return view('auth/register', [
            'title' => 'Inscription - LES3T',
        ]);
    }

    public function postRegister()
    {
        $fullName = trim((string) $this->request->getPost('full_name'));
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $confirm  = (string) $this->request->getPost('password_confirm');

        if ($password !== $confirm) {
            return redirect()->back()->withInput()->with('error', 'Les mots de passe ne correspondent pas.');
        }

        $userModel = new UserModel();
        $roleModel = new RoleModel();

        if ($userModel->findByEmail($email)) {
            return redirect()->back()->withInput()->with('error', 'Cet email est déjà utilisé.');
        }

        $userRole = $roleModel->where('slug', 'user')->first();

        $userModel->insert([
            'full_name'     => $fullName,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role_id'       => $userRole['id'],
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Compte créé. Vous pouvez vous connecter.');
    }

    public function getLogout()
    {
        session()->remove('user');
        session()->destroy();

        return redirect()->to(base_url('/'))->with('success', 'Vous êtes déconnecté.');
    }
}
