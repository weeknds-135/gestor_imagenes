<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class AlbumController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /** GET /albums */
    public function index()
    {
        // Recuperamos el ID del usuario autenticado de forma segura
        $userId = Auth::id();

        // En lugar de llamar a Auth::user()->albums(), consultamos directamente al modelo Album
        // buscando aquellos que le pertenezcan al usuario. Así VS Code no se confunde.
        $albums = Album::where('user_id', $userId)
            ->withCount('photos')
            ->latest()
            ->get();

        return view('albums.index', compact('albums'));
    }

    /** GET /albums/{album} */
    public function show(Album $album)
    {
        // Verificar que el álbum pertenece al usuario autenticado
        abort_if($album->user_id !== Auth::id(), 403);

        // Cargar las fotos del álbum (eager loading)
        $album->load('photos');

        return view('albums.show', compact('album'));
    }

    /** POST /albums */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        // Usamos la creación directa a través del modelo Album pasando el ID del usuario
        Album::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('albums.index')
            ->with('success', 'Álbum creado.');
    }

    /** DELETE /albums/{album} */
    public function destroy(Album $album)
    {
        abort_if($album->user_id !== Auth::id(), 403);
        $album->delete(); // cascade elimina las fotos automáticamente

        return back()->with('success', 'Álbum eliminado.');
    }
}