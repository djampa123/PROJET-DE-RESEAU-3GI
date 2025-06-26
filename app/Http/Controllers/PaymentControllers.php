<?php

namespace App\Http\Controllers;

use App\Models\DrivingSchool;
use Illuminate\Http\Request;

class PaymentControllers extends Controller
{
    // Affiche la page de paiement avec bouton "Payer"
    public function show($id)
    {
        $school = DrivingSchool::findOrFail($id);
        return view('payment.show', compact('school'));
    }

    // Simule le paiement et marque l'école comme "payée"
    public function process(Request $request, $id)
    {
        $school = DrivingSchool::findOrFail($id);

        // Simulation du paiement
        $school->is_paid = true;
        $school->is_approved = true;
        $school->save();

        // Affiche la page de succès directement
        return view('payment.success', compact('school'));
    }

    
}
