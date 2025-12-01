<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use CodeIgniter\HTTP\RedirectResponse;

class Users extends BaseController
{
    public function getIndex()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $db      = db_connect();
        $builder = $db->table('users u')
            ->select('u.*, r.name AS role_name, r.slug AS role_slug')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->orderBy('u.created_at', 'DESC');

        $users = $builder->get()->getResultArray();

        return $this->view('admin/users/index', [
            'title'       => 'Utilisateurs - Admin LES3T',
            'currentUser' => $currentUser,
            'users'       => $users,
        ], true);
    }

    public function getNew()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $roleModel = new RoleModel();
        $roles     = $roleModel->orderBy('name', 'ASC')->findAll();

        return $this->view('admin/users/form', [
            'title'       => 'Nouvel utilisateur',
            'currentUser' => $currentUser,
            'roles'       => $roles,
            'user'        => null,
        ], true);
    }

    public function postCreate()
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $fullName = trim((string) $this->request->getPost('full_name'));
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $confirm  = (string) $this->request->getPost('password_confirm');
        $roleId   = (int) $this->request->getPost('role_id');

        if ($password === '' || $password !== $confirm) {
            return redirect()->back()->withInput()->with('error', 'Mot de passe invalide ou non confirmé.');
        }

        $userModel = new UserModel();

        if ($userModel->findByEmail($email)) {
            return redirect()->back()->withInput()->with('error', 'Cet email est déjà utilisé.');
        }

        $userModel->insert([
            'full_name'     => $fullName,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role_id'       => $roleId,
        ]);

        return redirect()->to(base_url('admin/users'))
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function getEdit(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if (! $user) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Utilisateur introuvable.');
        }

        $roleModel = new RoleModel();
        $roles     = $roleModel->orderBy('name', 'ASC')->findAll();

        return $this->view('admin/users/form', [
            'title'       => 'Éditer un utilisateur',
            'currentUser' => $currentUser,
            'roles'       => $roles,
            'user'        => $user,
        ], true);
    }

    public function postUpdate(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if (! $user) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Utilisateur introuvable.');
        }

        $fullName = trim((string) $this->request->getPost('full_name'));
        $email    = trim((string) $this->request->getPost('email'));
        $roleId   = (int) $this->request->getPost('role_id');
        $password = (string) $this->request->getPost('password');
        $confirm  = (string) $this->request->getPost('password_confirm');

        $userModelExisting = $userModel
            ->where('email', $email)
            ->where('id !=', $id)
            ->first();

        if ($userModelExisting) {
            return redirect()->back()->withInput()->with('error', 'Cet email est déjà utilisé par un autre utilisateur.');
        }

        $data = [
            'full_name' => $fullName,
            'email'     => $email,
            'role_id'   => $roleId,
        ];

        if ($password !== '') {
            if ($password !== $confirm) {
                return redirect()->back()->withInput()->with('error', 'Les mots de passe ne correspondent pas.');
            }
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/users'))
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function postDelete(int $id)
    {
        $currentUser = $this->requireAdmin();
        if ($currentUser instanceof RedirectResponse) {
            return $currentUser;
        }

        if ($currentUser['id'] === $id) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if (! $user) {
            return redirect()->to(base_url('admin/users'))
                ->with('error', 'Utilisateur introuvable.');
        }

        $userModel->delete($id);

        return redirect()->to(base_url('admin/users'))
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
