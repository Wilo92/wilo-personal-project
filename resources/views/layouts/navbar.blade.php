<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top m-0 "
    style="background: linear-gradient(90deg,#004AAD,#FF7C00);">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-uppercase text-warning" href="#">
            <i class="bi bi-calendar-check"></i> Wilo <span class="text-light">Planner</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contacts.index')}}">Directory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Instructions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/Wilo92">Contact</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none text-white dropdown-toggle"
                        id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">

                        <!-- Imagen del usuario (cargada desde public/images) -->
                        <img src="{{ asset('images/logo.png') }}" alt="Wilo Avatar" width="40" height="40"
                            class="rounded-circle me-2"
                            style="object-fit: cover; border: 2px solid rgba(255,255,255,0.2);">

                        <span class="fw-semibold">Wilo</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="userMenu">
                        <li class="dropdown-item-text px-3">
                            <strong>Wilmer Restrepo</strong><br>
                            <small class="text-muted">wilmer.restrepo@hotmail.com</small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
