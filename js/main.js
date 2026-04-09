/**
 * Librería Luz Divina - JavaScript Principal
 * Funcionalidades: búsqueda, validación, animaciones
 */

document.addEventListener('DOMContentLoaded', function () {
    // =============================================
    // 1. Navbar scroll effect
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
                    card.style.animation = 'fadeInUp 0.4s ease-out';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Actualizar contador
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

            // Actualizar contador
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
                    // Validaciones extras
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
                // Scroll al primer campo inválido
                const firstInvalid = contactForm.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Mostrar spinner en el botón
                const btnSpinner = document.getElementById('btnSpinner');
                const btnEnviar = document.getElementById('btnEnviar');
                if (btnSpinner && btnEnviar) {
                    btnSpinner.classList.remove('d-none');
                    btnEnviar.disabled = true;
                }
            }
        });

        // Validación en tiempo real
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
    // 5. Contador de caracteres en textarea
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
    // 6. Scroll Reveal animations
    // =============================================
    const revealElements = document.querySelectorAll('.book-card-wrapper, .info-card, .author-row');
    
    const revealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    revealElements.forEach(function (el, index) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease ' + (index % 6) * 0.08 + 's, transform 0.5s ease ' + (index % 6) * 0.08 + 's';
        revealObserver.observe(el);
    });

    // =============================================
    // 7. Smooth scroll para anclas
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
