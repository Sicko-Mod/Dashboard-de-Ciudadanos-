<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\City; // Importa el modelo City
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo ciudadano.
     */
    public function create(City $city)
    {
        // Pasamos la ciudad a la vista para que el formulario sepa a qué ciudad añadir el ciudadano
        return view('citizens.create', compact('city'));
    }

    /**
     * Almacena un ciudadano recién creado en la base de datos.
     */
    public function store(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $city->citizens()->create([
                'name' => $request->name,
            ]);

            return redirect()->route('city.show', $city->id)->with('success', 'Ciudadano creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el ciudadano: ' . $e->getMessage());
        }
    }

    /**
     * Elimina el ciudadano especificado de la base de datos.
     */
    public function destroy(Citizen $citizen)
    {
        try {
            $cityName = $citizen->city->name; // Guarda el nombre de la ciudad antes de borrar el ciudadano
            $cityId = $citizen->city->id; // Guarda el ID de la ciudad para la redirección

            $citizen->delete();

            return redirect()->route('city.show', $cityId)->with('success', 'Ciudadano eliminado con éxito de ' . $cityName . '.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el ciudadano: ' . $e->getMessage());
        }
    }
}