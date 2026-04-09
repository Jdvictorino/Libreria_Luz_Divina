<?php
/**
 * Header común para todas las páginas
 * Librería Luz Divina
 */

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Librería Luz Divina - Tu librería online con los mejores libros y autores">
    <title>Librería Luz Divina<?php echo isset($pageTitle) ? ' - ' . $pageTitle : ''; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <i class="bi bi-book-half me-2"></i>
            <span class="brand-text">Librería <span class="brand-accent">Luz Divina</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="index.php">
                        <i class="bi bi-journal-bookmark-fill me-1"></i> Libros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'autores.php' ? 'active' : ''; ?>" href="autores.php">
                        <i class="bi bi-people-fill me-1"></i> Autores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'contacto.php' ? 'active' : ''; ?>" href="contacto.php">
                        <i class="bi bi-envelope-fill me-1"></i> Contacto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido Principal -->
<main class="main-content">
