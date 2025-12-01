<audio id="bg-music" preload="auto" loop>
    <source src="<?= base_url('audio/salou.mp3') ?>" type="audio/mpeg">
    Votre navigateur ne supporte pas l'audio HTML5.
</audio>

<button id="sound-toggle"
        style="
            position: fixed;
            right: 1.5rem;
            bottom: 1.5rem;
            z-index: 9999;
            border-radius: 999px;
            border: none;
            padding: .6rem 1rem;
            background: rgba(15,23,42,.9);
            color: #e5e7eb;
            font-size: .8rem;
            display: flex;
            align-items: center;
            gap: .4rem;
        ">
    <span id="sound-icon">🔇</span>
    <span id="sound-label">Activer le son</span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const audio = document.getElementById('bg-music');
        const btn   = document.getElementById('sound-toggle');
        const icon  = document.getElementById('sound-icon');
        const label = document.getElementById('sound-label');

        if (!audio || !btn) {
            console.error('Audio ou bouton introuvable');
            return;
        }

        // On démarre en mute + en pause (plus simple à gérer)
        audio.muted = true;

        btn.addEventListener('click', async () => {
            try {
                if (audio.paused) {
                    audio.muted  = false;
                    audio.volume = 0.3;
                    await audio.play();
                    icon.textContent  = '🔊';
                    label.textContent = 'Son activé';
                } else {
                    audio.pause();
                    icon.textContent  = '🔇';
                    label.textContent = 'Activer le son';
                }
            } catch (e) {
                console.error('Erreur lecture audio :', e);
            }
        });
    });
</script>

<main class="container py-5">

    <!-- SECTION HERO -->
    <section class="row align-items-center mb-5">

        <!-- Texte -->
        <div class="col-md-6">
            <h1 class="display-4 fw-bold mb-3">Location de voitures de luxe</h1>
            <p class="lead text-secondary mb-4">
                Bienvenue chez <strong>LES3T</strong>, votre maison pour les supercars, berlines
                et SUV de prestige, avec un service digne des palaces.
            </p>
            <a href="<?= base_url('cars') ?>" class="btn btn-light btn-lg">
                Découvrir la flotte
            </a>
        </div>

        <!-- 🎠 Carrousel -->
        <div class="col-md-6 text-center">

            <div class="p-4 rounded-4 shadow-lg"
                 style="background:radial-gradient(circle at top, #1e293b, #020617);">

                <div id="carsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                    <div class="carousel-inner rounded-4">

                        <?php
                        $images = [
                            'ferrari.png',
                            'gt3.png',
                            'gti.png',
                            'r8.png',
                            'rs3.png',
                            'c63.png',
                        ];
                        $first = true;
                        ?>

                        <?php foreach ($images as $img): ?>
                            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                <img src="<?= base_url('images/' . $img) ?>"
                                     class="d-block w-100 rounded-4"
                                     alt="Car"
                                     style="object-fit:cover; max-height:420px;">
                            </div>
                            <?php $first = false; ?>
                        <?php endforeach; ?>

                    </div>

                    <!-- Flèches -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>
            </div>

        </div>
    </section>

    <!-- 🎥 SECTION VIDEO CINÉMATIQUE -->
    <section class="my-5">
        <div class="video-wrapper rounded-4 shadow-lg mx-auto"
             style="overflow:hidden; max-width:1100px; background:#000;">
            <video class="w-100 d-block"
                   style="border-radius:1.5rem;"
                   autoplay
                   loop
                   muted
                   playsinline>
                <source src="<?= base_url('videos/coda-cars.mp4') ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture vidéo HTML5.
            </video>
        </div>

        <p class="text-center mt-3 text-secondary">
            Découvrez l’expérience <strong>LES3T</strong> en vidéo.
        </p>
    </section>


    <!-- FEATURES -->
    <section class="row g-4">
        <div class="col-md-4">
            <div class="p-4 rounded-4 border border-secondary-subtle h-100">
                <h3 class="h5 mb-2">Service Premium</h3>
                <p class="text-secondary mb-0">
                    Livraison à domicile, conciergerie 24/7 et accompagnement sur-mesure.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 rounded-4 border border-secondary-subtle h-100">
                <h3 class="h5 mb-2">Sélection exclusive</h3>
                <p class="text-secondary mb-0">
                    Supercars, GT, SUV et berlines de prestige sélectionnées avec soin.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 rounded-4 border border-secondary-subtle h-100">
                <h3 class="h5 mb-2">Expérience LES3T</h3>
                <p class="text-secondary mb-0">
                    Une signature visuelle, un accompagnement humain, une expérience mémorable.
                </p>
            </div>
        </div>
    </section>

</main>
</body>
</html>
