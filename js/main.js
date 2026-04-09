/**
 * Librería Luz Divina - JavaScript Principal
 * Funcionalidades: búsqueda, validación de formularios
 */

document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // 1. Efecto de navbar al hacer scroll
    // =============================================
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // =============================================
    // 2. Búsqueda en tiempo real - Libros
    // =============================================
    const searchBooks = document.getElementById('searchBooks');
    if (searchBooks) {
        searchBooks.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.book-card-wrapper');
            let visibleCount = 0;

            cards.forEach(function (card) {
                const searchData = card.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Actualizar contador de resultados
            const bookCount = document.getElementById('bookCount');
            if (bookCount) {
                bookCount.textContent = visibleCount + ' libros encontrados';
            }
        });
    }

    // =============================================
    // 3. Búsqueda en tiempo real - Autores
    // =============================================
    const searchAuthors = document.getElementById('searchAuthors');
    if (searchAuthors) {
        searchAuthors.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.author-row');
            let visibleCount = 0;

            rows.forEach(function (row) {
                const searchData = row.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Actualizar contador de resultados
            const authorCount = document.getElementById('authorCount');
            if (authorCount) {
                authorCount.textContent = visibleCount + ' autores registrados';
            }
        });
    }

    // =============================================
    // 4. Validación del formulario de contacto
    // =============================================
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            let isValid = true;
            const fields = contactForm.querySelectorAll('[required]');

            fields.forEach(function (field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                } else {
                    // Validaciones adicionales
                    if (field.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            isValid = false;
                            field.classList.add('is-invalid');
                            field.classList.remove('is-valid');
                        } else {
                            field.classList.add('is-valid');
                            field.classList.remove('is-invalid');
                        }
                    } else if (field.minLength > 0 && field.value.trim().length < field.minLength) {
                        isValid = false;
                        field.classList.add('is-invalid');
                        field.classList.remove('is-valid');
                    } else {
                        field.classList.add('is-valid');
                        field.classList.remove('is-invalid');
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Desplazar al primer campo inválido
                const firstInvalid = contactForm.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Mostrar indicador de carga en el botón
                const btnSpinner = document.getElementById('btnSpinner');
                const btnEnviar = document.getElementById('btnEnviar');
                if (btnSpinner && btnEnviar) {
                    btnSpinner.classList.remove('d-none');
                    btnEnviar.disabled = true;
                }
            }
        });

        // Validación en tiempo real al escribir
        contactForm.querySelectorAll('[required]').forEach(function (field) {
            field.addEventListener('input', function () {
                if (this.value.trim()) {
                    if (this.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailRegex.test(this.value)) {
                            this.classList.remove('is-invalid');
                            this.classList.add('is-valid');
                        }
                    } else if (this.minLength > 0 && this.value.trim().length >= this.minLength) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    }
                }
            });
        });
    }

    // =============================================
    // 5. Contador de caracteres en área de texto
    // =============================================
    const comentario = document.getElementById('comentario');
    const charCount = document.getElementById('charCount');
    if (comentario && charCount) {
        comentario.addEventListener('input', function () {
            const current = this.value.length;
            charCount.textContent = current;
            if (current > 900) {
                charCount.style.color = '#e94560';
            } else if (current > 700) {
                charCount.style.color = '#f5a623';
            } else {
                charCount.style.color = '';
            }
        });
    }

    // =============================================
    // 6. Desplazamiento suave para enlaces ancla
    // =============================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
