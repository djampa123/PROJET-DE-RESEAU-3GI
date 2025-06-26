<?php
// app/Http/Controllers/Auth/AuthenticatedSessionController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller {
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['token' => $token])->cookie('sanctum_token', $token, 60 * 24);
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies sont incorrectes.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}