<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cuisine::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'string'
        ]);

        $fields['name'] = strtolower($fields['name']);

        $cuisine = Cuisine::firstOrCreate(
            ['name' => $fields['name']],
            ['name' => $fields['name']]
        );

        return $cuisine;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cuisine::find($id);
    }

    public function search($name){
        return Cuisine::where('name', 'like', '%'.$name.'%')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cuisine = Cuisine::find($id);
        $cuisine->update($request->all());

        return $cuisine;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Cuisine::destroy($id);
    }
}
