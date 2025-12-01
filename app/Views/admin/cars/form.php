<?php
/** @var array|null $car */

$isEdit = isset($car) && isset($car['id']);
$action = $isEdit
    ? base_url('admin/cars/update/' . $car['id'])
    : base_url('admin/cars/create');
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <h1 class="h4 mb-4">
            <?= $isEdit ? 'Éditer une voiture' : 'Nouvelle voiture' ?>
        </h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger small">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="card card-glass">
            <div class="card-body">
                <form action="<?= $action ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Modèle *</label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               required
                               value="<?= old('name', $car['name'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Marque *</label>
                        <input type="text"
                               class="form-control"
                               id="brand"
                               name="brand"
                               required
                               value="<?= old('brand', $car['brand'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="daily_price" class="form-label">Tarif / jour (€) *</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               class="form-control"
                               id="daily_price"
                               name="daily_price"
                               required
                               value="<?= old('daily_price', $car['daily_price'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="image_url" class="form-label">Image (URL)</label>
                        <input type="url"
                               class="form-control"
                               id="image_url"
                               name="image_url"
                               placeholder="https://…"
                               value="<?= old('image_url', $car['image_url'] ?? '') ?>">
                        <div class="form-text small text-secondary">
                            Optionnel. Lien direct vers une image (800×600 ou plus).
                        </div>
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               id="is_active"
                               name="is_active"
                            <?= (int) old('is_active', $car['is_active'] ?? 1) === 1 ? 'checked' : '' ?>
                               value="1">
                        <label class="form-check-label" for="is_active">
                            Visible sur le site (page "Nos voitures")
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/cars') ?>" class="btn btn-outline-light">
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
</div>
