@extends('layouts.app')

@section('title', 'Inicio | Wilo sale')
@section('content')

    <section class="hero d-flex align-items-center justify-content-center text-center text-light">
        <div class="overlay"></div>
        <div class="content">
            <h1 class="fw-bold display-4">BIENVENIDO A <span class="text-warning">Wilo sale</span></h1>
            <p class="lead mb-4">los mejores productos , precios y marcas en un solo lugar</p>
            <a href="#" class="btn btn-warning btn-lg fw-semibold rounded-pill px-4 shadow">Ver productos</a>
        </div>

    </section>
    <style>
        .hero {
            position: relative;
            height: 85vh;
            background: linear-gradient(135deg, #0b1b3a 0%, #132d5a 50%, #1f4068 100%);
            color: white;
            overflow: hidden;
        }

        .hero .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero .content {
            position: relative;
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
