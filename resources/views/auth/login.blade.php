<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 420px; border-radius: 12px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Iniciar Sesión</h3>
                <p class="text-muted small">Ingresa tus credenciales para acceder a tus álbumes</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success py-2 small mb-3">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small text-secondary">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold small text-secondary">Contraseña</label>
                    <input id="password" type="password" name="password" class="form-control" required placeholder="Tu contraseña">
                </div>

                <div class="form-check mb-4 text-start">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label small text-muted">Recordar mi sesión</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm" style="border-radius: 8px;">
                        Ingresar
                    </button>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                        
                        <a class="text-decoration-none small fw-semibold" href="{{ route('register') }}">
                            Crear cuenta
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>