<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserSuperAdminController extends Controller
{
    public function index(): View
    {
        $users = User::where('role', 'gerant')->with('lieu')->orderBy('nom')->paginate(15);

        return view('superadmin.users.index', compact('users'));
    }

    public function create(): View
    {
        $lieux = Lieu::orderBy('nom')->get();

        return view('superadmin.users.create', compact('lieux'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'lieu_id' => ['required', 'exists:lieux,id'],
        ]);

        User::create([
            'name' => $validated['nom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'gerant',
            'lieu_id' => $validated['lieu_id'],
            'active' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('superadmin.users.index')->with('status', 'user-cree');
    }

    public function edit(User $user): View
    {
        abort_unless($user->role === 'gerant', 404);

        $lieux = Lieu::orderBy('nom')->get();

        return view('superadmin.users.edit', compact('user', 'lieux'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless($user->role === 'gerant', 404);

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8'],
            'lieu_id' => ['required', 'exists:lieux,id'],
        ]);

        $user->nom = $validated['nom'];
        $user->name = $validated['nom'];
        $user->email = $validated['email'];
        $user->lieu_id = $validated['lieu_id'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('superadmin.users.index')->with('status', 'user-modifie');
    }

    public function toggle(User $user): RedirectResponse
    {
        abort_unless($user->role === 'gerant', 404);

        $user->update(['active' => ! $user->active]);

        return back()->with('status', $user->active ? 'user-active' : 'user-desactive');
    }
}
