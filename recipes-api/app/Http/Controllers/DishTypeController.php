<?php

namespace App\Http\Controllers;

use App\Models\DishType;
use Illuminate\Http\Request;

class DishTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DishType::all();
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

        $dishType = DishType::firstOrCreate(
            ['name' => $fields['name']],
            ['name' => $fields['name']]
        );

        return $dishType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DishType  $dishType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DishType::find($id);
    }

    public function search($name){
        return DishType::where('name', 'like', '%'.$name.'%')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DishType  $dishType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dishType = DishType::find($id);
        $dishType->update($request->all());

        return $dishType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DishType  $dishType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DishType::destroy($id);
    }
}
