<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
        ]);

        $request->user()->update($request->only(['name', 'bio', 'phone']));
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|image|max:2048']);

        $user = $request->user();
        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['profile_photo_path' => $path]);

        return back()->with('success', 'Foto profil diperbarui!');
    }
}