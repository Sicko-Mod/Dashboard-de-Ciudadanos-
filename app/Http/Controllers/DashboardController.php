<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Citizen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCities = City::count();
        $totalCitizens = Citizen::count();
        $citiesWithCitizenCount = City::withCount('citizens')->orderBy('name', 'asc')->get();

        return view('dashboard', compact('totalCities', 'totalCitizens', 'citiesWithCitizenCount'));
    }

    public function showCity(Request $request, $id) // Inject Request
    {
        $city = City::findOrFail($id);
        $query = $city->citizens();

        // Implement search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%'); // Search by citizen name
        }

        $citizens = $query->orderBy('name', 'asc')->paginate(5)->withQueryString(); // Order by name and keep search query in pagination links
        $cities = City::all();

        return view('city', compact('city', 'citizens', 'cities'));
    }
}