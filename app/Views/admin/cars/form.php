<?php
/** @var array|null $car */
/** @var array $categories */

$isEdit = isset($car) && isset($car['id']);
$action = $isEdit
    ? base_url('admin/cars/update/' . $car['id'])
    : base_url('admin/cars/create');

$currentCategory = old('category', $car['category'] ?? 'sport');
?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <h1 class="h4 mb-3">
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
                            <label for="brand" class="form-label">Marque *</label>
                            <input type="text"
                                   class="form-control"
                                   id="brand"
                                   name="brand"
                                   required
                                   value="<?= old('brand', $car['brand'] ?? '') ?>">
                        </div>

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
                            <label for="category" class="form-label">Catégorie *</label>
                            <select name="category" id="category" class="form-select" required>
                                <?php foreach ($categories as $value => $label): ?>
                                    <option value="<?= esc($value) ?>"
                                        <?= $currentCategory === $value ? 'selected' : '' ?>>
                                        <?= esc($label) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
                            <label for="image_url" class="form-label">Image (URL ou chemin public)</label>

                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       id="image_url"
                                       name="image_url"
                                       placeholder="images/rs7.png ou https://…"
                                       value="<?= old('image_url', $car['image_url'] ?? '') ?>">

                                <button class="btn btn-outline-light" type="button"
                                        data-bs-toggle="modal" data-bs-target="#imageSelectorModal">
                                    Parcourir
                                </button>
                            </div>
                        </div>

                        <!-- MODAL SELECTEUR D'IMAGES -->
                        <div class="modal fade" id="imageSelectorModal" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="background:#0f172a; color:#e2e8f0;">
                                    <div class="modal-header border-secondary">
                                        <h5 class="modal-title">Choisir une image</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <?php if (empty($localImages)): ?>
                                            <p class="text-secondary mb-0">Aucune image trouvée dans <code>/public/images</code>.</p>
                                        <?php else: ?>
                                            <div class="row g-3">
                                                <?php foreach ($localImages as $img): ?>
                                                    <div class="col-6 col-md-4 col-lg-3">
                                                        <div class="selectable-image"
                                                             data-img="<?= esc($img) ?>"
                                                             style="cursor:pointer; border-radius:10px; overflow:hidden;
                                            background:#1e293b; padding:6px;">
                                                            <img src="<?= base_url($img) ?>"
                                                                 class="img-fluid rounded"
                                                                 style="object-fit:cover; width:100%; height:120px;">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SCRIPT DE SELECTION -->
                        <script>
                            document.querySelectorAll('.selectable-image').forEach(el => {
                                el.addEventListener('click', () => {
                                    const path = el.getAttribute('data-img');
                                    document.getElementById('image_url').value = path;

                                    // optionnel: retour visuel
                                    el.style.opacity = "0.6";

                                    // ferme le modal
                                    const modal = bootstrap.Modal.getInstance(
                                        document.getElementById('imageSelectorModal')
                                    );
                                    modal.hide();
                                });
                            });
                        </script>


                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                <?= (int) old('is_active', $car['is_active'] ?? 1) === 1 ? 'checked' : '' ?>
                                   value="1">
                            <label class="form-check-label" for="is_active">
                                Visible sur la page “Nos voitures”
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
</main>
