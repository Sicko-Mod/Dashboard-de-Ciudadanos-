<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('dashboard', compact('cities'));
    }

    public function showCity($id)
    {
        $city = City::findOrFail($id);
        $citizens = $city->citizens()->paginate(5);  // paginación 5 por página
        $cities = City::all();  // Para menú lateral

        return view('city', compact('city', 'citizens', 'cities'));
    }
}
