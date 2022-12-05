<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cats = Cat::all();
        return Inertia::render('Cat/Index', [
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

    public function client()
    {
        //
        return Inertia::render('Cat/Index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'age_category' => 'required',
            'tags' => 'required',
            'color' => 'required',
        ]);

        $image = '';
        if (FacadesRequest::file('image_path')) {
            $image = FacadesRequest::file('image_path')->store('cats', 'public');
        } else {
            $image = 'cats/default.png';
        };
        $cat = new Cat();
        $cat->name = $request->name;
        $cat->gender = $request->gender;
        $cat->age_category = $request->age_category;
        $cat->tags = $request->tags;
        $cat->color = $request->color;
        $cat->image_path = $image;
        $cat->save();

        return  redirect()->route('cats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        //
        // dd($request->all());
        $image = $cat->getAttributes()['image_path'];
        if (FacadesRequest::file('image_path')) {
            $image = FacadesRequest::file('image_path');
        }

        $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'age_category' => 'required',
            'tags' => 'required',
            'color' => 'required',
        ]);

        $cat->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'age_category' => $request->age_category,
            'tags' => $request->tags,
            'color' => $request->color,
            'image_path' => $image,
        ]);

        return  redirect()->route('cats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        dd($cat);
        //
        if ($cat->image_path != 'cats/default.png') {
            Storage::delete('public/' . $cat->image_path);
        }

        $cat->delete();

        return  redirect()->route('cats.index');
    }
}
