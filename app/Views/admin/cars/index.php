<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Voitures</h1>
    <a href="<?= base_url('admin/cars/new') ?>" class="btn btn-light btn-sm">
        <i class="fa-solid fa-plus me-1"></i> Nouvelle voiture
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

<div class="card card-glass">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Modèle</th>
                    <th>Marque</th>
                    <th>Tarif / jour</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($cars)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">
                            Aucune voiture enregistrée.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?= esc($car['id']) ?></td>
                            <td><?= esc($car['name']) ?></td>
                            <td><?= esc($car['brand']) ?></td>
                            <td><?= number_format((float) $car['daily_price'], 2, ',', ' ') ?> €</td>
                            <td>
                                <?php if ((int) $car['is_active'] === 1): ?>
                                    <span class="badge bg-success">Visible</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Masquée</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= base_url('admin/cars/edit/' . $car['id']) ?>"
                                   class="btn btn-sm btn-outline-light">
                                    Éditer
                                </a>
                                <form action="<?= base_url('admin/cars/delete/' . $car['id']) ?>"
                                      method="post"
                                      class="d-inline"
                                      onsubmit="return confirm('Supprimer cette voiture ?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Supprimer
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
