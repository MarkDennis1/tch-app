<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        if ($user->role === 'admin') {
            $volunteers = Volunteer::all();
            return Inertia::render('Volunteer/Index', [
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
        } else {
            $volunteers = Volunteer::query()->get(['*'])->where('user_id', '=', Auth::id());
            return Inertia::render('Volunteer/Client', [
                'volunteers' => $volunteers->map(function ($volunteer) {
                    return [
                        'id' => $volunteer->id,
                        'user_id' => $volunteer->user_id,
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function client()
    {
        return Inertia::render('Volunteer/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**x
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //first_name
        // last_name
        // address
        // number
        // occupation
        // email
        // age
        // interested_in
        // experience
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:100',
            'number' => 'required|min:11|max:11',
            'occupation' => 'required|max:50',
            'email' => 'required',
            'age' => 'required',
            'experience' => 'required|max:1000',
        ]);
        $volunteer = new Volunteer();
        $volunteer->user_id = Auth::id();
        $volunteer->first_name = $request->first_name;
        $volunteer->last_name = $request->last_name;
        $volunteer->address = $request->address;
        $volunteer->number = $request->number;
        $volunteer->occupation = $request->occupation;
        $volunteer->email = $request->email;
        $volunteer->age = $request->age;
        $volunteer->interested_in = $request->json_interested_in;
        $volunteer->experience = $request->experience;
        $volunteer->save();

        return  redirect()->route('volunteers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:100',
            'number' => 'required|max:11',
            'occupation' => 'required|max:50',
            'email' => 'required',
            'age' => 'required',
            'experience' => 'required|max:1000',
        ]);

        $volunteer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'number' => $request->number,
            'occupation' => $request->occupation,
            'email' => $request->email,
            'age' => $request->age,
            'interested_in' => $request->json_interested_in,
            'experience' => $request->experience,
        ]);

        return  redirect()->route('volunteers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        //
        $volunteer->delete();

        return  redirect()->route('volunteers.index');
    }
}
