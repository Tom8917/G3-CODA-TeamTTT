<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-lg" style="border-radius:1.5rem; background:#020617;">
                <div class="card-body p-4">
                    <h1 class="h4 fw-bold mb-3 text-center">Connexion</h1>

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

                    <form method="post" action="<?= base_url('login') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   required
                                   value="<?= old('email') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">
                                Se connecter
                            </button>
                        </div>
                    </form>

                    <p class="mt-3 mb-0 text-center small text-secondary">
                        Pas encore de compte ?
                        <a href="<?= base_url('register') ?>">Inscription</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
