<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="mb-3">
            <h1 class="h4 mb-1">Tableau de bord</h1>
            <p class="text-secondary mb-0">
                Bienvenue, <?= esc($currentUser['full_name'] ?? 'Admin') ?>. Gérez votre équipe et votre flotte de voitures de luxe.
            </p>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-glass h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-secondary small text-uppercase">Utilisateurs</span>
                    <i class="fa-solid fa-users text-warning"></i>
                </div>
                <div class="display-6 fw-semibold mb-1">
                    <?= esc($stats['usersCount'] ?? 0) ?>
                </div>
                <p class="small text-secondary mb-3">
                    Comptes enregistrés dans la plateforme.
                </p>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-light w-100">
                    Gérer les utilisateurs
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-glass h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-secondary small text-uppercase">Voitures</span>
                    <i class="fa-solid fa-car-side text-info"></i>
                </div>
                <div class="display-6 fw-semibold mb-1">
                    <?= esc($stats['carsCount'] ?? 0) ?>
                </div>
                <p class="small text-secondary mb-3">
                    Modèles disponibles dans le catalogue.
                </p>
                <a href="<?= base_url('admin/cars') ?>" class="btn btn-sm btn-outline-light w-100">
                    Gérer les voitures
                </a>
            </div>
        </div>
    </div>

    <!-- Carte d’accès rapide -->
    <div class="col-12 col-xl-6">
        <div class="card card-glass h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Accès rapide</h2>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <a href="<?= base_url('admin/users/new') ?>" class="text-decoration-none">
                            <div class="border rounded-4 p-3 h-100 d-flex flex-column justify-content-between"
                                 style="background: radial-gradient(circle at top left,#0f172a,#020617);">
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-2">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">Nouvel utilisateur</div>
                                            <div class="small text-secondary">Créer un compte administrateur ou client.</div>
                                        </div>
                                    </div>
                                </div>
                                <span class="small text-info mt-2">Commencer &rarr;</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6">
                        <a href="<?= base_url('admin/cars/new') ?>" class="text-decoration-none">
                            <div class="border rounded-4 p-3 h-100 d-flex flex-column justify-content-between"
                                 style="background: radial-gradient(circle at top left,#0b1120,#020617);">
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-2">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">Nouveau véhicule</div>
                                            <div class="small text-secondary">Ajouter une voiture à la flotte LES3T.</div>
                                        </div>
                                    </div>
                                </div>
                                <span class="small text-info mt-2">Ajouter &rarr;</span>
                            </div>
                        </a>
                    </div>
                </div>

                <hr class="border-secondary my-4">

                <p class="small text-secondary mb-0">
                    Cette interface admin vous permet de gérer les comptes utilisateurs et votre catalogue
                    de voitures de luxe. D’autres modules (réservations, paiements, etc.) pourront être ajoutés plus tard.
                </p>
            </div>
        </div>
    </div>
</div>
