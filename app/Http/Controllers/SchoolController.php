<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::limit(20)->orderBy("id")->paginate(20);

        return view('schools.index',compact('schools'))
        ->with('i', (request()->input('page', 1) - 1) * 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schools = request()->validate([
            'name' => 'required',
        ]);

        $schools = new School();
        $schools->name  = $request->name;

        $schools->save();
        return redirect()->route('schools.index')->with('success','School created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('schools.show',compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schools = request()->validate([
            'name' => 'required',

        ]);

       $schools = School::findOrFail($id);
       $schools->name = $request->name;
       $schools->save();
        return redirect()->route('schools.index')
                        ->with('success','school updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
