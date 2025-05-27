<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'descripcion',
    ];

    public function citizens()
{
    return $this->hasMany(Citizen::class);
}
public function index()
{
    $cities = City::withCount('citizens')->get();

    return view('dashboard', compact('cities'));
}
}

