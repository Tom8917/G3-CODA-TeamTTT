<?php
/** @var array $cars */
/** @var array|null $currentUser */
?>

<div class="mb-4 text-center">
    <h1 class="hero-title mb-2">Nos voitures de luxe</h1>
    <p class="hero-subtitle mb-0">
        Une sélection de véhicules d’exception, prêts à être loués pour vos événements, week-ends et séjours haut de gamme.
    </p>
</div>

<?php if (empty($cars)): ?>
    <div class="alert alert-info text-center mt-4">
        Aucune voiture n’est encore disponible. Revenez bientôt !
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($cars as $car): ?>
            <?php
            $rawImage = trim((string)($car['image_url'] ?? ''));

            // Normalisation de l’URL image
            if ($rawImage !== '' && ! preg_match('#^https?://#i', $rawImage)) {
                // → chemin interne (ex: "uploads/cars/rs7.jpg")
                $imageUrl = base_url($rawImage);
            } else {
                // → URL absolue ou vide
                $imageUrl = $rawImage;
            }
            ?>

            <div class="col-12 col-md-6 col-xl-4">
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
                        <div class="car-card-title">
                            <?= esc($car['name']) ?>
                        </div>

                        <p class="mt-2 mb-3 small text-secondary">
                            Véhicule haut de gamme sélectionné par LES3T pour une expérience de conduite premium.
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
