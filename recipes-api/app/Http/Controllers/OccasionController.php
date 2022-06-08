<?php

namespace App\Http\Controllers;

use App\Models\Occasion;
use Illuminate\Http\Request;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Occasion::all();
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
            'name' => 'string|nullable'
        ]);

        $fields['name'] = strtolower($fields['name']);

        Occasion::firstOrCreate(
            ['name' => $fields['name']],
            ['name' => $fields['name']]
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occasion  $occasion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Occasion::find($id);
    }

    public function search($name){
        return Occasion::where('name', 'like', '%'.$name.'%')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occasion  $occasion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $occasion = Occasion::find($id);
        $occasion->update($request->all());

        return $occasion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occasion  $occasion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Occasion::destroy($id);
    }
}
