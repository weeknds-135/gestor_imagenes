<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User; // <-- Añadimos esto explícitamente para que VS Code reconozca el tipo de usuario
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /** GET /profile — Mostrar formulario */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /** PUT /profile — Guardar cambios del perfil */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user(); // <-- Este comentario le dice a VS Code: "Trata a esta variable como el modelo User"

        // Rellena el nombre y el correo con lo que viene del formulario
        $user->fill($request->only('name', 'email'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Si el usuario escribió una nueva contraseña, la encripta y la guarda
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')
                         ->with('success', 'Perfil actualizado correctamente.');
    }

    /** DELETE /profile — Eliminar cuenta */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        /** @var User $user */
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}