@extends('layouts.app')

@section('title', 'Wilo Planner')
@section('content')

    <section class="hero d-flex align-items-center justify-content-center text-center text-light">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/images/banner1.png" class="d-block w-100 hero-img" alt="Imagen 1">
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
            <h1 class="fw-bold display-4">Welcome to <span class="text-warning">Wilo Planner</span></h1>
            <p class="lead mb-4">Your personal assistant for contacts and tasks. </p>
            <a href="#" class="btn btn-success btn-lg fw-semibold rounded-pill px-4 shadow">Contact Directory</a>
            <a href="#" class="btn btn-success btn-lg fw-semibold rounded-pill px-4 shadow">Task Planner</a>
        </div>

    </section>
    <style>
        .hero {
            position: relative;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            height: 85vh;
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
            height: 85vh;
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
    </style>

@endsection
