<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Utilisateurs</h1>
        <a href="<?= base_url('admin/users/new') ?>" class="btn btn-light btn-sm">
            Nouvel utilisateur
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="background:#020617;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">
                                Aucun utilisateur.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= esc($u['id']) ?></td>
                                <td><?= esc($u['full_name']) ?></td>
                                <td><?= esc($u['email']) ?></td>
                                <td><?= esc($u['role_name'] ?? 'N/A') ?></td>
                                <td class="small text-secondary"><?= esc($u['created_at'] ?? '') ?></td>
                                <td class="text-end">
                                    <a href="<?= base_url('admin/users/edit/' . $u['id']) ?>"
                                       class="btn btn-sm btn-outline-light">
                                        Éditer
                                    </a>
                                    <?php if ($currentUser['id'] !== $u['id']): ?>
                                        <form action="<?= base_url('admin/users/delete/' . $u['id']) ?>"
                                              method="post"
                                              class="d-inline"
                                              onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Supprimer
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
