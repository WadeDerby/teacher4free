<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Auth;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::where('username', Auth::user()->username)->first();
        return view('school.dashboard', compact('school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register.school');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    public function profile(School $school)
    {
        return view('school.profile');
    }
    public function skills(School $school)
    {
        return view('school.skills');
    }
    public function courses(School $school)
    {
        return view('school.courses');
    }
    public function qualification(School $school)
    {
        return view('school.qualification');
    }
    public function timeline(School $school)
    {
        return view('school.timeline');
    }
    public function messages(School $school)
    {
        return view('school.messages');
    }
    public function settings(School $school)
    {
        return view('school.settings');
    }
    public function search(Request $request)
    {
        dd($request->all());
        // return view('teacher.search');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
