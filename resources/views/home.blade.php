@extends('layouts.app')

@section('title', 'Wilo Planner')
@section('content')

    <section class="hero d-flex align-items-center justify-content-center text-center text-light">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/images/eo.png" class="d-block w-100 hero-img" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="/images/banner2.png" class="d-block w-100 hero-img" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="/images/banner3.png" class="d-block w-100 hero-img" alt="Imagen 3">
                </div>
                <div class="carousel-item">
                    <img src="/images/banner4.png" class="d-block w-100 hero-img" alt="">
                </div>
                <div class="carousel-item">
                    <img src="/images/banner5.png" class="d-block w-100 hero-img" alt="">
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="content">
            <h1 class="fw-bold display-4">Bienvenido a <span class="text-warning">Wilo</span>Link</h1>
            <p class="lead mb-4">Gestiona, Conecta, Proyecta. </p>
            <a href="{{route('contacts.index')}}" class="btn btn-success btn-lg fw-semibold rounded-pill px-4 shadow">Directorio</a>
            <a href="#" class="btn btn-success btn-lg fw-semibold rounded-pill px-4 shadow">ForoWeb</a>
        </div>

    </section>

   
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <section class="projects-section py-5">
        <div class="container">
            <h2 class="text-center text-dark mb-4">PROYECTOS</h2>

            <!-- Swiper -->
            <div class="swiper cards-swiper">
                <div class="swiper-wrapper">

                    
                    <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/feconder.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Feconder</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://feconder.github.io/','_blank')">VER</button>
                        </div>
                    </div>

                    <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/perfil.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Mi perfil</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://wilo92.github.io/myhdv/index.html','_blank')">VER</button>
                        </div>
                    </div>


                    <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/react.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">REACT</h5>
                            <h5 class="card-sub">Pagina inicio</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://wilo-app-react.vercel.app/','_blank')">VER</button>
                        </div>
                    </div>

                     <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/contraloria.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Contraloria Risaralda</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://intranetcontraloria.github.io/IntranetCGR/index.html','_blank')">VER</button>
                        </div>
                    </div>

                     <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/gradiente.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Gradiente</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://wilo92.github.io/myhdv/pagina_projects/collect-frondend/gradiente/index.html','_blank')">VER</button>
                        </div>
                    </div>


                     <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/fanta.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Fanta</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://wilo92.github.io/myhdv/pagina_projects/collect-frondend/fanta.com/index.html','_blank')">VER</button>
                        </div>
                    </div>

                     <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/camisas.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Tienda Camisas</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://frontprojects.vercel.app/TIENDACAMISAS/index.html','_blank')">VER</button>
                        </div>
                    </div>

                       <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/vehiculos.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Vehiculos</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://frontprojects.vercel.app/Vehiculo/index.html','_blank')">VER</button>
                        </div>
                    </div>

                     <div class="swiper-slide card-slide">
                        <div class="card-inner">
                            <div class="card-top">
                                <img src="/images/movies.jpg" alt="Python" class="card-thumb">
                            </div>
                            <h5 class="card-title">HTML,CSS,JAVASCRIPT</h5>
                            <h5 class="card-sub">Movies</h5>
                            <button class="btn btn-outline-light btn-sm btn-card"
                            onclick="window.open('https://frontprojects.vercel.app/MOVIES/index.html','_blank')">VER</button>
                        </div>
                    </div>
                    <!-- Slide ejemplo 2 -->
                   

                    <!-- Agrega más slides aquí -->
                </div>

               
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>


                <div class="swiper-pagination"></div>
            </div>
        </div>
        
    </section>

    <!-- Swiper JS (CDN) -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        /* ----- estilos generales del hero (mantengo los tuyos) ----- */
        #heroCarousel{
            position: absolute;
            top: 0%;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero {
            position: relative;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            height: 70vh;
            overflow: hidden;
            color: white;
        }

        .hero .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            max-width: 700px;
            padding: 0 20px;
        }

        .hero h1 span {
            color: #ffc107;
        }

        .hero .btn:hover {
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }

        /* ----- estilos del carrusel de tarjetas ----- */
        .projects-section {
            background: transparent;
            color: #fff;
        }

        .cards-swiper {
            padding: 30px 0 40px;
        }

        .swiper-wrapper {
            align-items: center;
        }

        .swiper-slide {
            width: 320px; /* ancho base de cada tarjeta */
            display: flex;
            justify-content: center;
        }

        .card-slide .card-inner {
            background: #2b2b2b;
            border-radius: 12px;
            padding: 24px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            text-align: center;
            color: #fff;
            transform-origin: center;
        }

        .card-top { height: 140px; display:flex; align-items:center; justify-content:center; margin-bottom: 14px; }
        .card-thumb { max-width: 100%; max-height: 100%; object-fit:contain; opacity: .95; }

        .card-title { color: #28a7ff; font-weight:700; margin-bottom:6px; }
        .card-sub { font-size: 14px; color:#fff; font-weight:700; margin-bottom:10px; }
        .card-desc { font-size: 13px; color:#ddd; min-height:44px; margin-bottom:16px; padding: 0 6px; }

        .btn-card {
            background: transparent;
            border: 2px solid rgba(255,110,40,0.9);
            color: #ff6e28;
            border-radius: 999px;
            padding: 8px 28px;
        }

        /* efecto de escala en slide central usando clase activa */
        .swiper-slide-active .card-inner {
            transform: scale(1.05);
            transition: transform .3s ease;
            z-index: 10;
            box-shadow: 0 18px 40px rgba(0,0,0,0.7);
        }

        .swiper-button-prev, .swiper-button-next {
            color: #ff6e28;
        }

        .swiper-pagination-bullet {
            background: rgba(255,255,255,0.3);
        }
        .swiper-pagination-bullet-active {
            background: #ff6e28;
        }

        /* responsive */
        @media (max-width: 768px) {
            .swiper-slide { width: 260px; }
        }
        @media (max-width: 480px) {
            .swiper-slide { width: 220px; }
        }
    </style>

    <script>
        // Inicializa Swiper. Lo ponemos aquí para que se ejecute cuando el documento cargue.
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.cards-swiper', {
                loop: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                // velocidad y efectos
                speed: 600,
                // puedes activar coverflow si quieres un efecto 3D
                effect: 'coverflow',
                coverflowEffect: {
                    rotate: 0,
                    stretch: -20,
                    depth: 120,
                    modifier: 1,
                    slideShadows: false,
                },
            });
        });
    </script>

@endsection
