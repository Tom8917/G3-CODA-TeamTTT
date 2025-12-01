<?php
/** @var array|null $currentUser */
$authUser = $currentUser ?? session('user');
$segment1 = service('uri')->getSegment(1);
$segment2 = service('uri')->getSegment(2);
?>

<header class="border-bottom border-slate-700 admin-nav-blur">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-uppercase" href="<?= base_url('admin') ?>">
                LES3T <span class="text-warning">Admin</span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#adminNavbar"
                    aria-controls="adminNavbar"
                    aria-expanded="false"
                    aria-label="Basculer la navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 === 'admin' && ($segment2 === '' || $segment2 === 'dashboard') ? 'active' : '' ?>"
                           href="<?= base_url('admin') ?>">
                            <i class="fa-solid fa-gauge-high me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 === 'admin' && $segment2 === 'users' ? 'active' : '' ?>"
                           href="<?= base_url('admin/users') ?>">
                            <i class="fa-solid fa-users me-1"></i> Utilisateurs
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($authUser): ?>
                        <li class="nav-item me-2">
                            <span class="navbar-text small">
                                <i class="fa-regular fa-circle-user me-1"></i>
                                <?= esc($authUser['full_name'] ?? 'Admin') ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-light" href="<?= base_url('logout') ?>">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Déconnexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="flex-fill py-4">
    <div class="container">
