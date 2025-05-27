<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitizenReportMail;
use App\Models\City; // Import City model

class ReportCitizenController extends Controller
{
    public function sendReport(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
        ]);

        try {
            $city = City::findOrFail($request->city_id);
            $userEmail = auth()->user()->email; // Get the authenticated user's email

            Mail::to($userEmail)->send(new CitizenReportMail($city));
            return redirect()->back()->with('success', 'Reporte enviado al correo electrónico con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al enviar el reporte: ' . $e->getMessage());
        }
    }
}