<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopt;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientAdoptController extends Controller
{
    //
    public function index()
    {
        $cats = Cat::all();
        return Inertia::render('Adopt/Client', [
            'cats' => $cats->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'gender' => $cat->gender,
                    'age_category' => $cat->age_category,
                    'tags' => $cat->tags,
                    'color' => $cat->color,
                    'image_path' => asset('storage/' . $cat->image_path),
                ];
            })
        ]);
    }
}
