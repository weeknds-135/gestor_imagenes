<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 450px; border-radius: 12px;">
            <div class="text-center mb-3">
                <h3 class="fw-bold text-primary">¿Olvidaste tu contraseña?</h3>
            </div>
            
            <p class="text-muted text-center small mb-4">
                No te preocupes. Escribe tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña y que puedas elegir una nueva.
            </p>

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

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold small text-secondary">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="correo@ejemplo.com">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm" style="border-radius: 8px;">
                        Enviar enlace de recuperación
                    </button>
                    <div class="text-center mt-2">
                        <a class="text-decoration-none small" href="{{ route('login') }}">
                            ← Volver al inicio de sesión
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>