<?php
/**
 * Página de Autores - Listado completo
 * Librería Luz Divina
 */
$pageTitle = 'Autores';
require_once 'config/database.php';
require_once 'includes/header.php';

// Consultar todos los autores con cantidad de libros
$sql = "SELECT a.id_autor, a.nombre, a.apellido, a.telefono, a.direccion, 
               a.ciudad, a.estado, a.pais,
               COUNT(ta.id_titulo) AS total_libros
        FROM autores a
        LEFT JOIN titulo_autor ta ON a.id_autor = ta.id_autor
        GROUP BY a.id_autor
        ORDER BY a.apellido ASC, a.nombre ASC";

$stmt = $pdo->query($sql);
$autores = $stmt->fetchAll();
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title animate-fade-in">
            <i class="bi bi-people-fill"></i> Nuestros Autores
        </h1>
        <p class="page-subtitle animate-fade-in-delay">Conoce a los escritores detrás de los mejores libros</p>
    </div>
</section>

<!-- Listado de Autores -->
<section class="section-content">
    <div class="container">
        <!-- Barra de búsqueda -->
        <div class="search-bar mb-5">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" id="searchAuthors" class="form-control" placeholder="Buscar autores por nombre, apellido o ciudad...">
            </div>
        </div>

        <!-- Contador -->
        <div class="results-counter mb-3">
            <span id="authorCount" class="badge bg-accent"><?php echo count($autores); ?> autores registrados</span>
        </div>

        <!-- Tabla de Autores -->
        <div class="table-responsive card-glass">
            <table class="table table-custom" id="authorsTable">
                <thead>
                    <tr>
                        <th><i class="bi bi-hash"></i> ID</th>
                        <th><i class="bi bi-person"></i> Nombre</th>
                        <th><i class="bi bi-person-badge"></i> Apellido</th>
                        <th><i class="bi bi-telephone"></i> Teléfono</th>
                        <th><i class="bi bi-geo-alt"></i> Ciudad</th>
                        <th><i class="bi bi-flag"></i> Estado</th>
                        <th><i class="bi bi-globe"></i> País</th>
                        <th><i class="bi bi-journal-text"></i> Libros</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($autores) > 0): ?>
                        <?php foreach ($autores as $autor): ?>
                            <tr class="author-row" data-search="<?php echo htmlspecialchars(strtolower($autor['nombre'] . ' ' . $autor['apellido'] . ' ' . $autor['ciudad'])); ?>">
                                <td><span class="badge bg-secondary-subtle text-dark"><?php echo htmlspecialchars($autor['id_autor']); ?></span></td>
                                <td class="fw-semibold"><?php echo htmlspecialchars($autor['nombre']); ?></td>
                                <td class="fw-semibold"><?php echo htmlspecialchars($autor['apellido']); ?></td>
                                <td><i class="bi bi-telephone-outbound text-muted me-1"></i><?php echo htmlspecialchars($autor['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($autor['ciudad']); ?></td>
                                <td><?php echo htmlspecialchars($autor['estado']); ?></td>
                                <td><?php echo htmlspecialchars($autor['pais']); ?></td>
                                <td><span class="badge bg-accent"><?php echo $autor['total_libros']; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-person-x"></i>
                                    <h5>No se encontraron autores</h5>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
