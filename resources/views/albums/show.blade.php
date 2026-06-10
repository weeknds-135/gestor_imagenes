<x-app-layout>
    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('albums.index') }}" class="btn btn-outline-secondary btn-sm fw-bold px-3" style="border-radius: 6px;">
                ← Volver a mis Álbumes
            </a>
            <span class="badge bg-primary px-3 py-2 fs-6 rounded-pill">
                {{ $album->photos->count() }} {{ $album->photos->count() == 1 ? 'Foto' : 'Fotos' }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert">
                <strong>¡Hecho!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px; background: white;">
                    <h3 class="fw-bold text-dark mb-1 text-truncate">{{ $album->title }}</h3>
                    <p class="text-secondary small mb-0">{{ $album->description ?? 'Sin descripción añadida.' }}</p>
                </div>

                <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 20px; border-radius: 12px; background: white;">
                    <h5 class="fw-bold text-primary mb-3">Añadir Fotografía</h5>
                    
                    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album->id }}">
                        
                        <div class="mb-3">
                            <label for="photo_title" class="form-label fw-semibold small text-secondary">Título de la foto</label>
                            <input type="text" name="title" id="photo_title" class="form-control" required placeholder="Ej. Atardecer en la playa">
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold small text-secondary">Seleccionar Imagen</label>
                            <input type="file" name="image" id="image" class="form-control" required accept="image/*">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold py-2 shadow-sm" style="border-radius: 8px;">
                                Subir Imagen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                @if($album->photos->isEmpty())
                    <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 12px; background: white;">
                        <h5 class="fw-bold text-secondary">Este álbum está vacío</h5>
                        <p class="text-muted small mb-0">Sube tu primera imagen usando el panel de la izquierda.</p>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                        @foreach($album->photos as $photo)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 12px; background: white;">
                                    
                                    <img src="{{ asset('storage/' . $photo->path) }}" 
                                         class="card-img-top img-fluid" 
                                         alt="{{ $photo->title }}" 
                                         style="height: 180px; object-fit: cover; cursor: zoom-in;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#zoomModal" 
                                         data-src="{{ asset('storage/' . $photo->path) }}"
                                         data-title="{{ $photo->title }}">
                                    
                                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                                        <h6 class="card-title fw-bold text-dark text-truncate mb-2">{{ $photo->title }}</h6>
                                        
                                        <div class="text-end pt-2 border-top">
                                            <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('¿Eliminar esta fotografía?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0 text-decoration-none small">
                                                    Eliminar Foto
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

    <div class="modal fade" id="zoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0 text-white pb-0">
                    <h5 class="modal-title fw-bold" id="zoomTitle">Imagen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-2">
                    <img src="" id="zoomImage" class="img-fluid rounded" style="max-height: 80vh; object-fit: contain; width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const zoomModal = document.getElementById('zoomModal');
            if(zoomModal) {
                zoomModal.addEventListener('show.bs.modal', function (event) {
                    const triggerImage = event.relatedTarget;
                    const imageSrc = triggerImage.getAttribute('data-src');
                    const imageTitle = triggerImage.getAttribute('data-title');
                    
                    document.getElementById('zoomImage').setAttribute('src', imageSrc);
                    document.getElementById('zoomTitle').textContent = imageTitle;
                });
            }
        });
    </script>
</x-app-layout>