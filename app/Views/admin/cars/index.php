<?php
/** @var array $cars */
/** @var array $categories */
/** @var array $currentUser */
?>

<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Voitures</h1>
            <p class="admin-section-subtitle mb-0">
                Gérez la flotte LES3T : ajout, édition, visibilité et catégories.
            </p>
        </div>
        <a href="<?= base_url('admin/cars/new') ?>" class="btn btn-pill-accent">
            <i class="fa-solid fa-plus me-2"></i> Nouvelle voiture
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger small">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success small">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <div class="card card-glass card-glass-sm card-glass-hover">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-modern mb-0 align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Voiture</th>
                        <th>Catégorie</th>
                        <th>Tarif / jour</th>
                        <th>Visible</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($cars)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">
                                Aucune voiture enregistrée pour le moment.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($cars as $car): ?>
                            <tr>
                                <td><?= esc($car['id']) ?></td>
                                <td>
                                    <div class="fw-semibold">
                                        <?= esc($car['brand']) ?> <?= esc($car['name']) ?>
                                    </div>
                                    <div class="small text-secondary">
                                        <?= esc($car['image_url'] ?: 'Pas d’image') ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-role-user">
                                        <?= esc($categories[$car['category']] ?? 'Autre') ?>
                                    </span>
                                </td>
                                <td>
                                    <?= number_format((float)$car['daily_price'], 2, ',', ' ') ?> €
                                </td>
                                <td>
                                    <?php if ((int)$car['is_active'] === 1): ?>
                                        <span class="badge bg-success-subtle text-success-emphasis">Oui</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">Non</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?= base_url('admin/cars/edit/' . $car['id']) ?>"
                                       class="btn btn-sm btn-soft">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="<?= base_url('admin/cars/delete/' . $car['id']) ?>"
                                          method="post"
                                          class="d-inline"
                                          onsubmit="return confirm('Supprimer cette voiture ?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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
