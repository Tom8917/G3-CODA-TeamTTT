<?php
/** @var array $cars */
/** @var array|null $currentUser */

// mapping catégories (clé en BDD → label affiché)
$categories = [
    'all'       => 'Toutes',
    'suv'       => 'SUV',
    'berline'   => 'Berlines',
    'sport'     => 'Sport',
    'cabriolet' => 'Cabriolets',
    'autre'     => 'Autres',
];
?>

<div class="mb-4 text-center">
    <h1 class="hero-title mb-2">Nos voitures de luxe</h1>
    <p class="hero-subtitle mb-0">
        Une sélection de véhicules d’exception, prêtes à être louées pour vos événements, week-ends et séjours haut de gamme.
    </p>
</div>

<?php if (empty($cars)): ?>
    <div class="alert alert-info text-center mt-4">
        Aucune voiture n’est encore disponible. Revenez bientôt !
    </div>
<?php else: ?>

    <!-- 🧩 FILTRES PAR CATÉGORIE -->
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
        <?php $first = true; ?>
        <?php foreach ($categories as $key => $label): ?>
            <button type="button"
                    class="btn btn-sm <?= $first ? 'btn-light' : 'btn-outline-light' ?> px-3 py-2 rounded-pill"
                    data-category-filter="<?= esc($key) ?>">
                <?= esc($label) ?>
            </button>
            <?php $first = false; ?>
        <?php endforeach; ?>
    </div>

    <!-- LISTE DES VOITURES -->
    <div class="row g-4" id="cars-grid">
        <?php foreach ($cars as $car): ?>
            <?php
            $rawImage = trim((string)($car['image_url'] ?? ''));
            $categoryKey = $car['category'] ?? 'autre';
            if (! array_key_exists($categoryKey, $categories)) {
                $categoryKey = 'autre';
            }

            // Normalisation de l’URL image
            if ($rawImage !== '' && ! preg_match('#^https?://#i', $rawImage)) {
                // → chemin interne (ex: "uploads/cars/rs7.jpg")
                $imageUrl = base_url($rawImage);
            } else {
                // → URL absolue ou vide
                $imageUrl = $rawImage;
            }
            ?>

            <div class="col-12 col-md-6 col-xl-4 car-item"
                 data-category="<?= esc($categoryKey) ?>">
                <div class="car-card">
                    <?php if ($imageUrl !== ''): ?>
                        <div class="car-card-image-wrapper">
                            <img src="<?= esc($imageUrl) ?>"
                                 alt="<?= esc($car['brand'] . ' ' . $car['name']) ?>">
                            <div class="car-card-gradient"></div>
                            <span class="car-brand-chip">
                                <?= esc($car['brand']) ?>
                            </span>
                        </div>
                    <?php else: ?>
                        <div class="p-4 text-center">
                            <div class="display-6 mb-2">
                                <i class="fa-solid fa-car-side"></i>
                            </div>
                            <p class="small text-secondary mb-0">
                                Image à venir.
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="car-card-body">
                        <div class="car-card-subtitle">
                            <?= esc(strtoupper($car['brand'])) ?>
                        </div>
                        <div class="car-card-title d-flex justify-content-between align-items-center">
                            <span><?= esc($car['name']) ?></span>
                            <span class="badge bg-secondary-subtle text-secondary-emphasis small">
                                <?= esc($categories[$categoryKey] ?? 'Autre') ?>
                            </span>
                        </div>

                        <p class="mt-2 mb-3 small text-secondary">
                            Véhicule <?= esc($categories[$categoryKey] ?? 'haut de gamme') ?> sélectionné par LES3T pour une expérience de conduite premium.
                        </p>

                        <div class="mt-auto d-flex justify-content-between align-items-end">
                            <div>
                                <div class="car-price-label">À partir de</div>
                                <div class="car-price-value">
                                    <?= number_format((float)$car['daily_price'], 2, ',', ' ') ?> € / jour
                                </div>
                            </div>
                            <button class="btn btn-soft-front" type="button" disabled>
                                Bientôt réservable
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

<!-- 🔁 SCRIPT DE FILTRAGE -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('[data-category-filter]');
        const items   = document.querySelectorAll('.car-item');

        if (!buttons.length || !items.length) {
            return;
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-category-filter');

                // style actif / inactif
                buttons.forEach(b => {
                    b.classList.remove('btn-light');
                    b.classList.add('btn-outline-light');
                });
                btn.classList.add('btn-light');
                btn.classList.remove('btn-outline-light');

                items.forEach(item => {
                    const itemCat = item.getAttribute('data-category');

                    if (filter === 'all' || filter === itemCat) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            });
        });
    });
</script>
