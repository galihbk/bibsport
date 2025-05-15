<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'identity_id' => 'required|string|max:50',
            'file_doc' => 'nullable|file|mimes:pdf|max:2048',
            'address' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        if ($request->hasFile('file_doc')) {
            if ($user->file_doc && \Storage::exists('uploads/docs/' . $user->file_doc)) {
                \Storage::delete('uploads/docs/' . $user->file_doc);
            }

            $filename = time() . '_' . $request->file('file_doc')->getClientOriginalName();
            $request->file('file_doc')->storeAs('uploads/docs', $filename);

            $user->file_doc = $filename;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->identity_id = $request->identity_id;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function downloadDokumen($filename)
    {
        $user = Auth::user();
        $path = 'uploads/docs/' . $filename;
        // dd(Storage::disk('local')->exists($path));
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $owner = \App\Models\User::where('file_doc', $filename)->first();
        if (!$owner || $owner->id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke dokumen ini.');
        }

        return Storage::disk('local')->download($path);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();

        if ($user->photo && Storage::disk('public')->exists('profile/' . $user->image)) {
            Storage::disk('public')->delete('profile/' . $user->image);
        }
        $file = $request->file('photo');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('profile', $filename, 'public');

        $user->image = $filename;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
