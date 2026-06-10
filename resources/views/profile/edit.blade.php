<x-app-layout>
    <div class="container py-4" style="max-width: 600px; margin: auto;">
        <h2>Editar Perfil</h2>

        @if(session('success'))
            <div class="alert alert-success" style="color: green; background: #e6ffed; padding: 10px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="color: red; background: #ffeef0; padding: 10px; margin-bottom: 15px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" style="width:100%; padding:8px;">
            </div>

            <div class="mb-3" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Correo electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" style="width:100%; padding:8px;">
            </div>

            <div class="mb-3" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Nueva contraseña (opcional)</label>
                <input type="password" name="password" class="form-control" style="width:100%; padding:8px;">
            </div>

            <div class="mb-3" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" style="width:100%; padding:8px;">
            </div>

            <button type="submit" style="background: blue; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                Guardar cambios
            </button>
        </form>
    </div>
</x-app-layout>