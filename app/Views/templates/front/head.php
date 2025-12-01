<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= esc($title ?? 'LES3T – Location de voitures de luxe') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <style>
        :root {
            --front-bg: #020617;
            --front-accent: #22c55e;
            --front-accent-2: #38bdf8;
            --front-card-bg: rgba(15,23,42,0.94);
            --front-text: #e5e7eb;
            --front-text-soft: #9ca3af;
            --radius-xl: 1.5rem;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--front-text);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                    radial-gradient(circle at 0% 0%, rgba(56,189,248,0.25), transparent 55%),
                    radial-gradient(circle at 100% 0%, rgba(34,197,94,0.25), transparent 55%),
                    radial-gradient(circle at 50% 110%, rgba(59,130,246,0.14), transparent 60%),
                    linear-gradient(135deg, #0f172a, #020617);
        }

        .front-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAV FRONT */

        .front-nav {
            background: linear-gradient(90deg, rgba(15,23,42,0.96), rgba(15,23,42,0.92));
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(148,163,184,0.25);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            font-size: .9rem;
        }

        .navbar-brand span {
            font-weight: 500;
            font-size: .75rem;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .navbar-dark .navbar-nav .nav-link {
            font-size: .9rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #f9fafb;
        }

        .navbar-dark .navbar-nav .nav-link.active {
            position: relative;
        }

        .navbar-dark .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            left: .6rem;
            right: .6rem;
            bottom: -0.25rem;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--front-accent), var(--front-accent-2));
        }

        /* HERO / TITRES */

        .hero-title {
            font-size: clamp(2.3rem, 4vw, 3.2rem);
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .hero-subtitle {
            font-size: .98rem;
            color: var(--front-text-soft);
        }

        /* CARDS VOITURES */

        .car-card {
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: var(--front-card-bg);
            border: 1px solid rgba(148,163,184,0.22);
            box-shadow:
                    0 22px 55px rgba(15,23,42,0.85),
                    0 0 0 1px rgba(15,23,42,0.9);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform .18s ease-out, box-shadow .18s ease-out, border-color .18s ease-out;
        }

        .car-card:hover {
            transform: translateY(-4px);
            border-color: rgba(34,197,94,0.45);
            box-shadow:
                    0 28px 70px rgba(15,23,42,0.95),
                    0 0 0 1px rgba(34,197,94,0.45);
        }

        .car-card-image-wrapper {
            position: relative;
            height: 230px;
            overflow: hidden;
        }

        .car-card-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.03);
            transition: transform .25s ease-out;
        }

        .car-card:hover .car-card-image-wrapper img {
            transform: scale(1.07);
        }

        .car-card-gradient {
            position: absolute;
            inset: 0;
            background:
                    linear-gradient(to top, rgba(15,23,42,0.9), transparent 55%),
                    radial-gradient(circle at top left, rgba(34,197,94,0.25), transparent 55%);
        }

        .car-brand-chip {
            position: absolute;
            left: 0.9rem;
            bottom: 0.9rem;
            padding: .2rem .7rem;
            border-radius: 999px;
            font-size: .72rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            background: rgba(15,23,42,0.9);
            color: var(--front-text-soft);
            border: 1px solid rgba(148,163,184,0.7);
        }

        .car-card-body {
            padding: 1.2rem 1.4rem 1.3rem;
            display: flex;
            flex-direction: column;
            gap: .35rem;
            flex: 1;
        }

        .car-card-title {
            font-size: 1.15rem;
            font-weight: 600;
        }

        .car-card-subtitle {
            font-size: .85rem;
            color: var(--front-text-soft);
            text-transform: uppercase;
            letter-spacing: .16em;
        }

        .car-price-label {
            font-size: .75rem;
            color: var(--front-text-soft);
            text-transform: uppercase;
            letter-spacing: .15em;
        }

        .car-price-value {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .btn-soft-front {
            border-radius: 999px;
            border-color: rgba(148,163,184,0.7);
            font-size: .8rem;
        }

        .btn-soft-front:hover {
            border-color: rgba(34,197,94,0.7);
            background: rgba(15,23,42,0.7);
        }

        footer {
            color: var(--front-text-soft);
        }

        @media (max-width: 768px) {
            .navbar-dark .navbar-nav .nav-link {
                font-size: .8rem;
            }
        }
    </style>
</head>
<body>
<div class="front-shell">
