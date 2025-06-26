<?php

// app/Http/Controllers/DrivingSchoolController.php

namespace App\Http\Controllers;

use App\Models\DrivingSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrivingSchoolController extends Controller
{
    // Affichage de la liste des auto-écoles approuvées
   public function index(Request $request)
{
    $query = DrivingSchool::query()->where('is_approved', true);

    // Recherche stricte par nom
    if ($request->filled('name')) {
        $query->where('name', $request->name);
    }

    // Recherche stricte par ville
    if ($request->filled('city')) {
        $query->where('city', $request->city);
    }

    // Recherche stricte par type de permis et prix max dans la table license_offers
    if ($request->filled('license_type') || $request->filled('max_price')) {
        $query->whereHas('licenseOffers', function ($q) use ($request) {
            if ($request->filled('license_type')) {
                $q->where('license_type', $request->license_type);
            }
            if ($request->filled('max_price')) {
                $q->where('price', '<=', $request->max_price);
            }
        });
    }

    $schools = $query->get();

    return view('driving_schools.index', compact('schools'));
}


    // Formulaire d'inscription
    public function create()
    {
        return view('driving_schools.create');
    }
    public function show($id)
{
    $school = DrivingSchool::findOrFail($id);
    return view('driving_schools.show', compact('school'));
}

    // Enregistrement d'une auto-école
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'city' => 'required',
        'email' => 'required|email|unique:driving_schools,email',
        'phone' => 'required',
        'document' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'image' => 'nullable|image|max:2048',
        'license_types' => 'required|array|min:1',
        'license_types.*' => 'in:A,B,C,D,E',
        'license_prices' => 'required|array',
        'license_prices.*' => 'numeric|min:0',
    ]);

    // Stocker les fichiers
    $documentPath = $request->file('document')->store('documents');
    $imagePath = $request->file('image') ? $request->file('image')->store('public/images') : null;
    if ($imagePath) {
        $imagePath = str_replace('public/', '', $imagePath);
    }

    // Créer l'auto-école
    $school = DrivingSchool::create([
        'name' => $request->name,
        'city' => $request->city,
        'email' => $request->email,
        'phone' => $request->phone,
        'offer' => $request->offer,
        'rating' => 0,
        'document_path' => $documentPath,
        'image' => $imagePath,
        'is_approved' => false,
        // Plus de champ price ici, supprimé car on stocke prix par permis
    ]);
        
    // Stocker les prix par type de permis dans license_offers (relation hasMany)
    foreach ($request->license_types as $type) {
        // S'assurer que le prix est bien renseigné pour ce type
        if (isset($request->license_prices[$type])) {
            $school->licenseOffers()->create([
                'license_type' => $type,
                'price' => $request->license_prices[$type],
            ]);
        }
    }
       
    return redirect()->route('driving_schools.show', $school->id);
}


    public function simulatePayment($id)
{
    $school = \App\Models\DrivingSchool::findOrFail($id);
    $school->is_paid = true;
    $school->save();

    return view('payment.success', compact('school'));
}

}

