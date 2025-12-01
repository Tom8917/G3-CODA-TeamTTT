<?php $user = session('user'); ?>
<nav style="padding: 1rem 2rem; display:flex; justify-content:space-between; align-items:center; background:#050608; color:#f5f5f5;">
    <div>
        <a href="<?= base_url('/') ?>" style="text-decoration:none; color:#f5f5f5; font-weight:bold; letter-spacing:0.2em;">
            LES3T
        </a>
    </div>
    <div style="display:flex; gap:1rem; align-items:center;">
        <a href="<?= base_url('/') ?>" style="color:#e5e7eb; text-decoration:none;">Accueil</a>
        <a href="<?= base_url('cars') ?>" style="color:#e5e7eb; text-decoration:none;">Voitures</a>

        <?php if (! $user): ?>
            <a href="<?= base_url('login') ?>" style="color:#e5e7eb; text-decoration:none;">Connexion</a>
            <a href="<?= base_url('register') ?>" style="color:#e5e7eb; text-decoration:none;">Inscription</a>
        <?php else: ?>
            <?php if (($user['role_slug'] ?? null) === 'admin'): ?>
                <a href="<?= base_url('admin') ?>" style="color:#fde047; text-decoration:none;">Admin</a>
            <?php endif; ?>
            <span style="font-size:0.9rem; color:#9ca3af;">Bonjour, <?= esc($user['full_name']) ?></span>
            <a href="<?= base_url('logout') ?>" style="color:#f87171; text-decoration:none;">Déconnexion</a>
        <?php endif; ?>
    </div>
</nav>
