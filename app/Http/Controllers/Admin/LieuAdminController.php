<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LieuAdminController extends Controller
{
    public function edit(): View
    {
        $lieu = Auth::user()->lieu;

        return view('admin.lieu.edit', compact('lieu'));
    }

    public function update(Request $request): RedirectResponse
    {
        $lieu = Auth::user()->lieu;

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:150'],
            'adresse' => ['required', 'string', 'max:250'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'horaires' => ['nullable', 'string', 'max:200'],
            'tarifs' => ['nullable', 'string', 'max:200'],
            'photo' => ['nullable', 'image', 'max:2048', 'dimensions:min_width=300,min_height=200'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('lieux', 'public');
        }

        $lieu->update($validated);

        return redirect()->route('admin.lieu.edit')->with('status', 'lieu-mis-a-jour');
    }
}
