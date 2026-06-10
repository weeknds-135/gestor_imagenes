<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 450px; border-radius: 12px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Crear Cuenta</h3>
                <p class="text-muted small">Regístrate para gestionar tus álbumes de fotos</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small text-secondary">Nombre Completo</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Ej. Juan Pérez">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small text-secondary">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="juan@ejemplo.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold small text-secondary">Contraseña</label>
                    <input id="password" type="password" name="password" class="form-control" required placeholder="Mínimo 8 caracteres">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold small text-secondary">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required placeholder="Repite tu contraseña">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm" style="border-radius: 8px;">
                        Registrarse
                    </button>
                    <div class="text-center mt-3">
                        <a class="text-decoration-none small" href="{{ route('login') }}">
                            ¿Ya estás registrado? Inicia sesión
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>