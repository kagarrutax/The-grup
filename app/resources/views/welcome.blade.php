@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
<div class="marketing-home">
    <nav class="navbar-landing">
        <div class="container">
            <a href="#inicio" class="navbar-brand">
                <i class="bi bi-box"></i>
                <span>The Grup</span>
            </a>

            <div class="navbar-menu">
                <a href="#inicio">Inicio</a>
                <a href="#caracteristicas">Características</a>
                <a href="#beneficios">Beneficios</a>
                <a href="#precios">Precios</a>
                <a href="#contacto">Contacto</a>
            </div>

            <a href="{{ route('login') }}" class="btn btn-nav-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar sesión
            </a>
        </div>
    </nav>

    <section class="hero-section" id="inicio">
        <div class="container hero-grid">
            <div class="hero-copy">
                <span class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Plataforma de inventario para negocios
                </span>

                <h1>
                    Ordena tu inventario con una herramienta
                    <span>clara, rápida y profesional</span>
                </h1>

                <p>
                    Centraliza productos, categorías y movimientos en un solo lugar.
                    El home principal presenta tu marca y el acceso queda separado en la pantalla de inicio de sesión.
                </p>

                <div class="hero-actions">
                    <a href="#caracteristicas" class="btn btn-primary-landing">Ver características</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-landing">Ir al login</a>
                </div>

                <div class="hero-stats">
                    <div class="stat-card">
                        <strong>{{ $highlights['products'] ?? 0 }}</strong>
                        <span>Productos registrados</span>
                    </div>
                    <div class="stat-card">
                        <strong>{{ $highlights['categories'] ?? 0 }}</strong>
                        <span>Categorías activas</span>
                    </div>
                    <div class="stat-card">
                        <strong>{{ $highlights['movements'] ?? 0 }}</strong>
                        <span>Movimientos procesados</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="visual-frame">
                    <div class="visual-tag">The Grup</div>
                    <h2>Tu operación más ordenada desde el primer día</h2>
                    <p>Una landing limpia para presentar el sistema, captar clientes y dirigir el acceso administrativo solo donde corresponde.</p>

                    <div class="visual-points">
                        <div class="visual-point">
                            <i class="bi bi-check2-circle"></i>
                            <span>Acceso separado en `/login`</span>
                        </div>
                        <div class="visual-point">
                            <i class="bi bi-check2-circle"></i>
                            <span>Inicio enfocado en ventas y presentación</span>
                        </div>
                        <div class="visual-point">
                            <i class="bi bi-check2-circle"></i>
                            <span>Diseño adaptable para escritorio y móvil</span>
                        </div>
                    </div>
                </div>

                <div class="floating-card floating-card-top">
                    <i class="bi bi-shield-check"></i>
                    <div>
                        <strong>Acceso controlado</strong>
                        <span>Solo desde la ruta de autenticación</span>
                    </div>
                </div>

                <div class="floating-card floating-card-bottom">
                    <i class="bi bi-graph-up-arrow"></i>
                    <div>
                        <strong>Presentación comercial</strong>
                        <span>Ideal para mostrar beneficios del sistema</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section" id="caracteristicas">
        <div class="container">
            <div class="section-heading">
                <span class="section-kicker">Características</span>
                <h2>Todo lo necesario para controlar tu inventario</h2>
                <p>El home ahora comunica el valor del sistema sin mezclar pantallas internas del producto.</p>
            </div>

            <div class="features-grid">
                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3>Gestión de productos</h3>
                    <p>Organiza referencias, categorías y stock desde una estructura clara.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <h3>Movimientos precisos</h3>
                    <p>Registra entradas y salidas con seguimiento confiable para cada artículo.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <h3>Información útil</h3>
                    <p>Consulta datos clave para tomar decisiones con más rapidez.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="benefits-section" id="beneficios">
        <div class="container benefits-grid">
            <div>
                <span class="section-kicker">Beneficios</span>
                <h2>Una portada que vende mejor tu sistema</h2>
                <p class="section-text">
                    Separar la landing del acceso administrativo mejora la imagen del proyecto,
                    evita confusión al visitante y mantiene el dashboard como área privada.
                </p>
            </div>

            <div class="benefits-list">
                <div class="benefit-item">
                    <i class="bi bi-check-lg"></i>
                    <span>Mejor experiencia para clientes y visitantes.</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-check-lg"></i>
                    <span>El login queda en una ruta exclusiva y más clara.</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-check-lg"></i>
                    <span>El dashboard no aparece en el home público.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-section" id="precios">
        <div class="container">
            <div class="section-heading">
                <span class="section-kicker">Precios</span>
                <h2>Un plan simple para empezar</h2>
                <p>Presenta tu propuesta con claridad y deja la operación diaria dentro del panel privado.</p>
            </div>

            <div class="pricing-card">
                <span class="pricing-label">Plan integral</span>
                <h3>Inventario inteligente para tu negocio</h3>
                <p>Incluye control de productos, categorías, movimientos y acceso administrativo.</p>
                <a href="{{ route('login') }}" class="btn btn-primary-landing">Acceder al sistema</a>
            </div>
        </div>
    </section>

    <section class="contact-section" id="contacto">
        <div class="container contact-box">
            <div>
                <span class="section-kicker">Contacto</span>
                <h2>¿Listo para continuar?</h2>
                <p>Usa esta portada para presentar The Grup y dirige el ingreso al sistema desde el botón de acceso.</p>
            </div>

            <a href="{{ route('login') }}" class="btn btn-outline-landing">
                <i class="bi bi-send"></i>
                Ir a iniciar sesión
            </a>
        </div>
    </section>
</div>

<style>
    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
        background: #f8fafc;
        color: #0f172a;
    }

    a {
        text-decoration: none;
    }

    .marketing-home {
        min-height: 100vh;
    }

    .container {
        width: min(1200px, calc(100% - 2rem));
        margin: 0 auto;
    }

    .navbar-landing {
        position: sticky;
        top: 0;
        z-index: 50;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(148, 163, 184, 0.18);
    }

    .navbar-landing .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        min-height: 88px;
    }

    .navbar-brand {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        color: #0f172a;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .navbar-brand i {
        color: #6366f1;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .navbar-menu a {
        color: #64748b;
        font-weight: 500;
    }

    .navbar-menu a:hover {
        color: #4f46e5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        border-radius: 0.9rem;
        padding: 0.95rem 1.4rem;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .btn-nav-login,
    .btn-outline-landing {
        border: 1px solid #c7d2fe;
        color: #4f46e5;
        background: #ffffff;
    }

    .btn-primary-landing {
        color: #ffffff;
        background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.24);
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .hero-section {
        padding: 5rem 0 4rem;
        background:
            radial-gradient(circle at top left, rgba(99, 102, 241, 0.15), transparent 28%),
            radial-gradient(circle at bottom right, rgba(124, 58, 237, 0.14), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
        gap: 3rem;
        align-items: center;
    }

    .hero-badge,
    .section-kicker,
    .visual-tag,
    .pricing-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.9rem;
        border-radius: 999px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .hero-copy h1 {
        margin: 1.25rem 0 1rem;
        font-size: clamp(2.6rem, 5vw, 4.5rem);
        line-height: 1.05;
        letter-spacing: -0.04em;
    }

    .hero-copy h1 span {
        color: #5b5bd6;
    }

    .hero-copy p,
    .section-heading p,
    .section-text,
    .pricing-card p,
    .contact-box p,
    .visual-frame p {
        color: #64748b;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin: 2rem 0;
    }

    .hero-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    .stat-card,
    .feature-card,
    .pricing-card,
    .contact-box,
    .benefit-item,
    .visual-frame,
    .floating-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 1.4rem;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
    }

    .stat-card {
        padding: 1.25rem;
    }

    .stat-card strong {
        display: block;
        font-size: 1.9rem;
        margin-bottom: 0.35rem;
    }

    .stat-card span {
        color: #64748b;
        font-size: 0.95rem;
    }

    .hero-visual {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1.5rem;
    }

    .visual-frame {
        width: 100%;
        max-width: 440px;
        padding: 2rem;
        background: linear-gradient(180deg, #ffffff 0%, #eef2ff 100%);
        position: relative;
        z-index: 1;
    }

    .visual-frame h2 {
        margin: 1rem 0 0.75rem;
        font-size: 2rem;
    }

    .visual-points {
        display: grid;
        gap: 0.85rem;
        margin-top: 1.5rem;
    }

    .visual-point,
    .benefit-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }

    .visual-point i,
    .benefit-item i,
    .floating-card i {
        color: #4f46e5;
        font-size: 1.2rem;
    }

    .floating-card {
        position: absolute;
        width: min(250px, calc(100% - 2rem));
        padding: 1rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        z-index: 2;
    }

    .floating-card strong {
        display: block;
        margin-bottom: 0.2rem;
    }

    .floating-card span {
        color: #64748b;
        font-size: 0.9rem;
    }

    .floating-card-top {
        top: 0.75rem;
        left: 0.5rem;
    }

    .floating-card-bottom {
        right: 0.5rem;
        bottom: 1.5rem;
    }

    .features-section,
    .benefits-section,
    .pricing-section,
    .contact-section {
        padding: 5rem 0;
    }

    .features-section,
    .pricing-section {
        background: #ffffff;
    }

    .section-heading {
        max-width: 760px;
        margin: 0 auto 3rem;
        text-align: center;
    }

    .section-heading h2,
    .benefits-grid h2,
    .contact-box h2 {
        margin: 1rem 0 0.75rem;
        font-size: clamp(2rem, 4vw, 3rem);
        line-height: 1.1;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        padding: 2rem;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 1rem;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 1.6rem;
        margin-bottom: 1rem;
    }

    .feature-card h3 {
        margin-bottom: 0.7rem;
        font-size: 1.25rem;
    }

    .feature-card p {
        margin: 0;
        color: #64748b;
        line-height: 1.7;
    }

    .benefits-section {
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(320px, 420px);
        gap: 2rem;
        align-items: start;
    }

    .benefits-list {
        display: grid;
        gap: 1rem;
    }

    .benefit-item {
        padding: 1.2rem 1.25rem;
    }

    .pricing-card {
        max-width: 760px;
        margin: 0 auto;
        padding: 2.2rem;
        text-align: center;
    }

    .pricing-card h3 {
        margin: 1rem 0 0.75rem;
        font-size: 2rem;
    }

    .contact-box {
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    @media (max-width: 1200px) {
        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            min-height: auto;
            padding: 0;
            display: grid;
            gap: 1rem;
        }

        .visual-frame {
            max-width: 100%;
        }

        .floating-card {
            position: static;
            width: 100%;
            margin-top: 0;
        }
    }

    @media (max-width: 992px) {
        .navbar-menu {
            display: none;
        }

        .benefits-grid,
        .features-grid,
        .hero-stats {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            min-height: auto;
        }

        .floating-card {
            position: static;
            width: 100%;
            margin-top: 1rem;
        }

        .contact-box {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection
