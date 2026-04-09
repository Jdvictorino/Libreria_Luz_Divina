<?php
/**
 * Página de Contacto
 * Librería Luz Divina
 */
$pageTitle = 'Contacto';
require_once 'config/database.php';
require_once 'includes/header.php';

// Verificar si hay mensaje de éxito o error
$mensaje = '';
$tipo_mensaje = '';
if (isset($_GET['success'])) {
    $mensaje = '¡Mensaje enviado correctamente! Nos pondremos en contacto contigo pronto.';
    $tipo_mensaje = 'success';
} elseif (isset($_GET['error'])) {
    $mensaje = 'Hubo un error al enviar el mensaje. Por favor, intenta de nuevo.';
    $tipo_mensaje = 'danger';
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title animate-fade-in">
            <i class="bi bi-envelope-fill"></i> Contáctanos
        </h1>
        <p class="page-subtitle animate-fade-in-delay">¿Tienes alguna pregunta? ¡Nos encantaría saber de ti!</p>
    </div>
</section>

<!-- Formulario de Contacto -->
<section class="section-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php if ($mensaje): ?>
                    <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show animate-fade-in" role="alert">
                        <i class="bi bi-<?php echo $tipo_mensaje === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>-fill me-2"></i>
                        <?php echo $mensaje; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="contact-card card-glass">
                    <div class="contact-card-header">
                        <i class="bi bi-chat-dots-fill"></i>
                        <h3>Formulario de Contacto</h3>
                        <p>Completa el formulario a continuación y te responderemos lo antes posible.</p>
                    </div>
                    <form id="contactForm" action="procesar_contacto.php" method="POST" novalidate>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required minlength="2" maxlength="100">
                                    <label for="nombre"><i class="bi bi-person me-1"></i> Nombre completo</label>
                                    <div class="invalid-feedback">Por favor, ingresa tu nombre (mínimo 2 caracteres).</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                                    <label for="correo"><i class="bi bi-envelope me-1"></i> Correo electrónico</label>
                                    <div class="invalid-feedback">Por favor, ingresa un correo electrónico válido.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Asunto" required minlength="3" maxlength="200">
                                    <label for="asunto"><i class="bi bi-tag me-1"></i> Asunto</label>
                                    <div class="invalid-feedback">Por favor, ingresa el asunto del mensaje (mínimo 3 caracteres).</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="comentario" name="comentario" placeholder="Tu mensaje" style="height: 160px" required minlength="10" maxlength="1000"></textarea>
                                    <label for="comentario"><i class="bi bi-chat-left-text me-1"></i> Comentario</label>
                                    <div class="invalid-feedback">Por favor, escribe tu mensaje (mínimo 10 caracteres).</div>
                                </div>
                                <div class="char-counter text-end mt-1">
                                    <small class="text-muted"><span id="charCount">0</span>/1000 caracteres</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-send w-100" id="btnEnviar">
                                    <i class="bi bi-send-fill me-2"></i> Enviar Mensaje
                                    <span class="spinner-border spinner-border-sm ms-2 d-none" id="btnSpinner" role="status"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info de contacto lateral -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="contact-info-cards">
                    <div class="info-card card-glass">
                        <div class="info-card-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h6>Dirección</h6>
                        <p>Santo Domingo, República Dominicana</p>
                    </div>
                    <div class="info-card card-glass">
                        <div class="info-card-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h6>Teléfono</h6>
                        <p>+1 (809) 555-0123</p>
                    </div>
                    <div class="info-card card-glass">
                        <div class="info-card-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h6>Correo</h6>
                        <p>info@librerialuzdivina.com</p>
                    </div>
                    <div class="info-card card-glass">
                        <div class="info-card-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <h6>Horario</h6>
                        <p>Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábados: 9:00 AM - 1:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
