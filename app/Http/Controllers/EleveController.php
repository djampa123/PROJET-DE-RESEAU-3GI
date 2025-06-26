<?php
namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    public function create()
    {
        return view('eleves.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:eleves',
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Eleve::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('eleves.create')
            ->with('success', 'Compte élève créé avec succès');
    }

    public function showLoginForm()
    {
        return view('eleves.login');
    }
    public function dashboard()
    {
        return view('eleves.dashboard');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('eleve')->attempt($credentials)) {
            return redirect()->route('eleves.dashboard')
                ->with('success', 'Connexion réussie !');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email ou mot de passe incorrect'])
            ->withInput();
    }


    public function logout(Request $request)
    {
        Auth::guard('eleve')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('eleves.login')
            ->with('success', 'Déconnexion réussie !');
    }

    
}

