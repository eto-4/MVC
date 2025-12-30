<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir FlashMessages si no se ha hecho globalmente
require_once APP_ROOT . '/helpers/FlashMessages.php';
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicació MVC</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalitzat -->
    <link href="<?= BASE_PATH ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegació -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_PATH ?>/">MVC App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/">Inici</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/tasques">Tasques</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_PATH ?>/tasques/create">Nova Tasca</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Mostrar Flash Messages si n'hi ha -->
        <?php FlashMessages::display(); ?>
    </div>
