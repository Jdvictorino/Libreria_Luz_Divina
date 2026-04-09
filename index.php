<?php
/**
 * Página principal - Listado de Libros
 * Librería Luz Divina
 */
$pageTitle = 'Libros';
require_once 'config/database.php';
require_once 'includes/header.php';

// Consultar todos los libros con su autor y publicador
$sql = "SELECT t.id_titulo, t.titulo, t.tipo, t.precio, t.total_ventas, t.notas, t.fecha_pub,
               p.nombre_pub,
               GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) SEPARATOR ', ') AS autores
        FROM titulos t
        LEFT JOIN publicadores p ON t.id_pub = p.id_pub
        LEFT JOIN titulo_autor ta ON t.id_titulo = ta.id_titulo
        LEFT JOIN autores a ON ta.id_autor = a.id_autor
        GROUP BY t.id_titulo
        ORDER BY t.titulo ASC";

$stmt = $pdo->query($sql);
$libros = $stmt->fetchAll();

// Mapear tipos a etiquetas en español
$tipos = [
    'business'     => 'Negocios',
    'mod_cook'     => 'Cocina Moderna',
    'trad_cook'    => 'Cocina Tradicional',
    'popular_comp' => 'Computación',
    'psychology'   => 'Psicología',
    'UNDECIDED'    => 'Sin definir',
];
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1 class="hero-title animate-fade-in">
            <i class="bi bi-book-half"></i>
            Librería <span class="text-accent">Luz Divina</span>
        </h1>
        <p class="hero-subtitle animate-fade-in-delay">Descubre nuestra colección de libros seleccionados especialmente para ti</p>
        <a href="#libros" class="btn btn-hero animate-fade-in-delay-2">
            <i class="bi bi-arrow-down-circle me-2"></i> Explorar Libros
        </a>
    </div>
</section>

<!-- Listado de Libros -->
<section id="libros" class="section-content">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-journal-bookmark-fill"></i> Catálogo de Libros</h2>
            <p class="section-subtitle">Explora nuestra amplia selección de títulos disponibles</p>
        </div>

        <!-- Barra de búsqueda -->
        <div class="search-bar mb-5">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" id="searchBooks" class="form-control" placeholder="Buscar libros por título, autor o categoría...">
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="results-counter mb-3">
            <span id="bookCount" class="badge bg-accent"><?php echo count($libros); ?> libros encontrados</span>
        </div>

        <!-- Grid de libros -->
        <div class="row g-4" id="booksGrid">
            <?php if (count($libros) > 0): ?>
                <?php foreach ($libros as $libro): ?>
                    <div class="col-lg-4 col-md-6 book-card-wrapper" data-search="<?php echo htmlspecialchars(strtolower($libro['titulo'] . ' ' . ($libro['autores'] ?? '') . ' ' . ($tipos[$libro['tipo']] ?? $libro['tipo']))); ?>">
                        <div class="book-card">
                            <div class="book-card-header">
                                <span class="book-category"><?php echo htmlspecialchars($tipos[$libro['tipo']] ?? $libro['tipo']); ?></span>
                                <?php if ($libro['precio']): ?>
                                    <span class="book-price">$<?php echo number_format($libro['precio'], 2); ?></span>
                                <?php else: ?>
                                    <span class="book-price no-price">Sin precio</span>
                                <?php endif; ?>
                            </div>
                            <div class="book-cover-wrapper">
                                <?php
                                    $imgPath = 'images/books/' . strtoupper($libro['id_titulo']) . '.png';
                                    if (file_exists($imgPath)):
                                ?>
                                    <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($libro['titulo']); ?>" class="book-cover-img" loading="lazy">
                                <?php else: ?>
                                    <div class="book-cover-placeholder">
                                        <i class="bi bi-book"></i>
                                        <span>Sin portada</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="book-card-body">
                                <h5 class="book-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                                <p class="book-author">
                                    <i class="bi bi-person-fill"></i>
                                    <?php echo htmlspecialchars($libro['autores'] ?? 'Autor desconocido'); ?>
                                </p>
                                <p class="book-publisher">
                                    <i class="bi bi-building"></i>
                                    <?php echo htmlspecialchars($libro['nombre_pub'] ?? 'N/A'); ?>
                                </p>
                            </div>
                            <div class="book-card-footer">
                                <div class="book-stats">
                                    <span><i class="bi bi-cart-check"></i> <?php echo $libro['total_ventas'] ?? 0; ?> vendidos</span>
                                    <span><i class="bi bi-calendar3"></i> <?php echo date('d/m/Y', strtotime($libro['fecha_pub'])); ?></span>
                                </div>
                            </div>
                            <?php if (!empty($libro['notas'])): ?>
                                <div class="book-notes">
                                    <p><?php echo htmlspecialchars(mb_strimwidth($libro['notas'], 0, 120, '...')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>No se encontraron libros</h4>
                        <p>Aún no hay libros disponibles en el catálogo.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
