<x-app-layout>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center text-md-start">
                <h2 class="fw-bold text-dark mb-1">¡Bienvenido de nuevo, {{ Auth::user()->name }}!</h2>
                <p class="text-muted">Este es tu panel principal del Gestor de Imágenes.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm p-4 text-center text-md-start" style="border-radius: 12px; background: white;">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <h5 class="fw-bold mb-1 text-success">Sesión Iniciada con Éxito</h5>
                            <p class="text-secondary small mb-0">Ya puedes empezar a organizar tus fotografías en carpetas virtuales de manera privada.</p>
                        </div>
                        <div>
                            <a href="{{ route('albums.index') }}" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" style="border-radius: 8px;">
                                Ir a mis Álbumes →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>