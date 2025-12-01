<?php
/** @var array|null $user */
/** @var array      $roles */

$isEdit = isset($user) && isset($user['id']);
$action = $isEdit
    ? base_url('admin/users/update/' . $user['id'])
    : base_url('admin/users/create');
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">

            <h1 class="h4 mb-4">
                <?= $isEdit ? 'Éditer un utilisateur' : 'Nouvel utilisateur' ?>
            </h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger small">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= $action ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Nom complet</label>
                    <input type="text"
                           class="form-control"
                           id="full_name"
                           name="full_name"
                           required
                           value="<?= old('full_name', $user['full_name'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           required
                           value="<?= old('email', $user['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Rôle</label>
                    <select name="role_id" id="role_id" class="form-select" required>
                        <option value="">Sélectionner…</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['id'] ?>"
                                <?= (int) old('role_id', $user['role_id'] ?? 0) === (int) $role['id'] ? 'selected' : '' ?>>
                                <?= esc($role['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Mot de passe
                        <?php if ($isEdit): ?>
                            <span class="text-muted small">(laisser vide pour ne pas changer)</span>
                        <?php endif; ?>
                    </label>
                    <input type="password"
                           class="form-control"
                           id="password"
                           name="password"
                        <?= $isEdit ? '' : 'required' ?>>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirmation mot de passe</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirm"
                           name="password_confirm"
                        <?= $isEdit ? '' : 'required' ?>>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-light">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-warning">
                        <?= $isEdit ? 'Mettre à jour' : 'Créer' ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
