<x-app-layout>
    <div class="container py-5">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert">
                <strong>¡Hecho!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 20px; border-radius: 12px; background: white;">
                    <h4 class="fw-bold text-primary mb-3">Nuevo Álbum</h4>
                    <p class="text-muted small">Crea un contenedor para organizar tus fotografías.</p>
                    
                    <form action="{{ route('albums.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold small text-secondary">Título del Álbum</label>
                            <input type="text" name="title" id="title" class="form-control" required placeholder="Ej. Vacaciones 2026">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold small text-secondary">Descripción (Opcional)</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Breve reseña del álbum..."></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="bi bi-plus-circle me-1"></i> Crear Álbum
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-dark m-0">Mis Álbumes</h3>
                    <span class="badge bg-secondary px-3 py-2 fs-6 rounded-pill">Total: {{ $albums->count() }}</span>
                </div>

                @if($albums->isEmpty())
                    <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 12px; background: white;">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-muted" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                <path d="M10.648 7.646a.5.5 0 0 1 .708 0l2.25 2.25a.5.5 0 0 1-.708.708l-2.25-2.25a.5.5 0 0 1 0-.708m-5.324.214a.5.5 0 0 1 .693.125l.8 1.2a.5.5 0 0 1-.832.554l-.8-1.2a.5.5 0 0 1 .139-.679m-1.74 1.95a.5.5 0 0 1 .707 0l1.5 1.5a.5.5 0 1 1-.707.707l-1.5-1.5a.5.5 0 0 1 0-.707M5 6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </div>
                        <h5 class="fw-bold text-secondary">No tienes álbumes todavía</h5>
                        <p class="text-muted small mx-auto" style="max-width: 350px;">Utiliza el formulario de la izquierda para agregar tu primer álbum de fotografías.</p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach($albums as $album)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm transition-card" style="border-radius: 12px; background: white;">
                                    <div class="card-body p-4 d-flex flex-col justify-content-between">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h5 class="card-title fw-bold text-dark m-0 text-truncate" style="max-width: 80%;">
                                                    {{ $album->title }}
                                                </h5>
                                                <span class="badge bg-primary rounded-pill small">
                                                    {{ $album->photos_count }} {{ $album->photos_count == 1 ? 'foto' : 'fotos' }}
                                                </span>
                                            </div>
                                            <p class="card-text text-secondary small mb-4 text-muted">
                                                {{ $album->description ?? 'Sin descripción añadida.' }}
                                            </p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                            <a href="{{ route('albums.show', $album) }}" class="btn btn-outline-primary btn-sm fw-bold px-3" style="border-radius: 6px;">
                                                Ver Fotos →
                                            </a>
                                            
                                            <form action="{{ route('albums.destroy', $album) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este álbum?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0 text-decoration-none small">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>