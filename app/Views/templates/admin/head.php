<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= esc($title ?? 'Admin - LES3T') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
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
            --admin-bg: #050816;
            --admin-bg-soft: #070b1e;
            --admin-card: rgba(15, 23, 42, 0.96);
            --admin-accent: #38bdf8;
            --admin-accent-soft: rgba(56,189,248,0.25);
            --admin-accent-2: #a855f7;
            --admin-text: #e5e7eb;
            --admin-text-soft: #9ca3af;
            --radius-xl: 1.4rem;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--admin-text);
            background:
                    radial-gradient(circle at 0% 0%, rgba(56,189,248,0.25), transparent 55%),
                    radial-gradient(circle at 100% 0%, rgba(168,85,247,0.22), transparent 55%),
                    radial-gradient(circle at 50% 110%, rgba(34,197,94,0.18), transparent 60%),
                    linear-gradient(135deg, #020617, #020617 35%, #020617 100%);
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR ADMIN */
        .admin-nav-blur {
            background: radial-gradient(circle at top left, rgba(15,23,42,0.96), rgba(15,23,42,0.9));
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(148,163,184,0.24);
        }

        .navbar-brand span {
            letter-spacing: .05em;
        }

        .navbar-dark .navbar-nav .nav-link {
            font-size: .9rem;
            letter-spacing: .03em;
            text-transform: uppercase;
            padding-inline: 0.95rem;
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #e5e7eb;
        }

        .navbar-dark .navbar-nav .nav-link.active {
            position: relative;
        }

        .navbar-dark .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            left: 0.75rem;
            right: 0.75rem;
            bottom: -0.3rem;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--admin-accent), var(--admin-accent-2));
        }

        /* CARDS / TABLES */

        .card-glass {
            background: radial-gradient(circle at top left, rgba(15,23,42,0.97), rgba(15,23,42,0.96));
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.28);
            box-shadow:
                    0 18px 45px rgba(15,23,42,0.85),
                    0 0 0 1px rgba(15,23,42,0.9);
        }

        .card-glass-sm {
            border-radius: 1rem;
        }

        .card-glass-hover {
            transition: transform .16s ease-out, box-shadow .16s ease-out, border-color .16s ease-out;
        }

        .card-glass-hover:hover {
            transform: translateY(-2px);
            box-shadow:
                    0 24px 60px rgba(15,23,42,0.95),
                    0 0 0 1px var(--admin-accent-soft);
            border-color: var(--admin-accent-soft);
        }

        .pill-metric {
            display: inline-flex;
            align-items: baseline;
            gap: .25rem;
            font-size: 1.9rem;
            font-weight: 600;
        }

        .pill-label {
            font-size: .7rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--admin-text-soft);
        }

        .badge-role-admin {
            background: linear-gradient(135deg, #fbbf24, #fb923c);
            color: #0f172a;
            border-radius: 999px;
            padding-inline: .7rem;
            font-size: .7rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .badge-role-user {
            background: rgba(148,163,184,0.25);
            color: #e5e7eb;
            border-radius: 999px;
            padding-inline: .7rem;
            font-size: .7rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        /* TABLES */

        .table-modern thead tr {
            background: linear-gradient(90deg, rgba(15,23,42,0.95), rgba(15,23,42,0.92));
        }

        .table-modern thead th {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            border-bottom-color: rgba(55,65,81,0.9);
            color: var(--admin-text-soft);
        }

        .table-modern tbody tr {
            border-color: rgba(31,41,55,0.9);
        }

        .table-modern tbody tr:hover {
            background: radial-gradient(circle at left, rgba(56,189,248,0.08), transparent 55%);
        }

        .btn-soft {
            border-radius: 999px;
            border-color: rgba(148,163,184,0.6);
            font-size: .78rem;
        }

        .btn-soft:hover {
            border-color: var(--admin-accent-soft);
            background: rgba(15,23,42,0.7);
        }

        .btn-pill-accent {
            border-radius: 999px;
            background: linear-gradient(90deg, var(--admin-accent), var(--admin-accent-2));
            border: none;
            color: #0b1120;
            font-weight: 600;
            font-size: .8rem;
        }

        .btn-pill-accent:hover {
            filter: brightness(1.05);
            color: #020617;
        }

        .admin-section-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .admin-section-subtitle {
            font-size: .9rem;
            color: var(--admin-text-soft);
        }

        footer {
            color: var(--admin-text-soft);
        }

        @media (max-width: 768px) {
            .navbar-dark .navbar-nav .nav-link {
                font-size: .8rem;
            }
        }
    </style>
</head>
<body>
<div class="admin-shell">
