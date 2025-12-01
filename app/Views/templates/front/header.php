<?php
/** @var array|null $currentUser */
$authUser = $currentUser ?? session('user');
$segment1 = service('uri')->getSegment(1);
?>

<header class="front-nav border-bottom border-slate-800">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase" href="<?= base_url('/') ?>">
                LES3T
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#frontNavbar"
                    aria-controls="frontNavbar"
                    aria-expanded="false"
                    aria-label="Basculer la navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="frontNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 === '' ? 'active' : '' ?>"
                           href="<?= base_url('/') ?>">
                            Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 === 'cars' ? 'active' : '' ?>"
                           href="<?= base_url('cars') ?>">
                            Nos voitures
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($authUser): ?>
                        <li class="nav-item me-2">
                            <span class="navbar-text small">
                                <i class="fa-regular fa-circle-user me-1"></i>
                                <?= esc($authUser['full_name'] ?? 'Client') ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-light" href="<?= base_url('logout') ?>">
                                Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item me-2">
                            <a class="btn btn-sm btn-outline-light" href="<?= base_url('login') ?>">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-info" href="<?= base_url('register') ?>">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="flex-fill py-4">
    <div class="container">
