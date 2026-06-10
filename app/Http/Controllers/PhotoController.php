<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Almacenar una nueva fotografía en el servidor y BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Máximo 5MB
        ]);

        // Guardar la imagen físicamente en storage/app/public/photos
        $path = $request->file('image')->store('photos', 'public');

        // Crear registro en la BD
        Photo::create([
            'album_id' => $request->album_id,
            'title' => $request->title,
            'path' => $path,
        ]);

        return back()->with('success', '¡Fotografía añadida con éxito al álbum!');
    }

    /**
     * Eliminar una fotografía de forma segura.
     */
    public function destroy(Photo $photo)
    {
        // Solución estricta para Intelephense: Validar que el usuario sea dueño del álbum
        $currentUserId = Auth::id();

        if ($photo->album->user_id !== $currentUserId) {
            abort(403, 'No tienes autorización para realizar esta acción.');
        }

        // Eliminar el archivo físico del almacenamiento local
        if (Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }

        // Eliminar registro de la base de datos
        $photo->delete();

        return back()->with('success', 'Fotografía eliminada correctamente.');
    }
}