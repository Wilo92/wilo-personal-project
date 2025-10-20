<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="width:24rem;">

            <h1>iniciar sesion</h1>

            @if ($errors->any())
                <div style="color:red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <div>
                    <label class="form-label" for="email">Correo electronico</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="form-label" for="password">Contraseña</label>
                    <input class="form-control" type="password" id="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <div style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </div>

    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
