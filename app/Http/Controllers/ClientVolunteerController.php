<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClientVolunteerController extends Controller
{
    //
    public function index()
    {

        $volunteers = Volunteer::query()->get(['*'])->where('user_id', '=', Auth::id());
        return Inertia::render('Volunteer/Client', [
            'volunteers' => $volunteers->map(function ($volunteer) {
                return [
                    'id' => $volunteer->id,
                    'first_name' => $volunteer->first_name,
                    'last_name' => $volunteer->last_name,
                    'address' => $volunteer->address,
                    'number' => $volunteer->number,
                    'occupation' => $volunteer->occupation,
                    'email' => $volunteer->email,
                    'age' => $volunteer->age,
                    'interested_in' => $volunteer->interested_in,
                    'experience' => $volunteer->experience,
                ];
            })
        ]);
    }
}
