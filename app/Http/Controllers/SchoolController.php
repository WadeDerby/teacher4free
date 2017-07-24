<?php

namespace App\Http\Controllers;

use App\School;
use App\Skill;
use App\Course;
use App\Teacher;
use App\User;
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
        $teachers = $this->getTeachers(Auth::user()->entity_id);
        return view('school.dashboard', compact('school', 'teachers'));
    }

    public function home(){
        $school = School::where('username', Auth::user()->username)->first();
        $teachers = $this->getTeachers(Auth::user()->entity_id);
        return view('school.home', compact('school', 'teachers'));
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
        $school = School::where('id', Auth::user()->entity_id)->first();
        return view('school.profile' , compact('school'));
    }
    public function skills(School $school)
    {
        $skills = Skill::where('entity_id', 'S' . Auth::user()->entity_id)->get();
        $school = School::where('id', Auth::user()->entity_id)->first();
        return view('school.skills' , compact('school', 'skills'));
    }
    public function courses(School $school)
    {
        $school = School::where('id', Auth::user()->entity_id)->first();
        $courses = Course::where('entity_id','S' . Auth::user()->entity_id)->get();
        return view('school.courses' , compact('school' , 'courses'));
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
        // return view('school.search');
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


    public function updateProfile(Request $request, School $school)
    {
        $school = School::where('id', Auth::user()->entity_id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $school->name =  $request->name;
        $school->username = $user->username  = $request->username;
        $school->location = $request->location;
        $school->age = $request->age;
        $schoolSaved = $school->save();
        $userSaved = $user->save();

        $success = ['error' => false, 'message' => 'User edited successfully'];
        $fail = ['error' => true, 'message' => 'Something went wrong, could not save user details']; 

        if( $schoolSaved && $userSaved ){
         return response()->json($success);   
        }else{
            return response()->json($fail);
        }
    }

    public function updateSkills(Request $request, School $school)
    {
        $skills = $request->skills;
        foreach ($skills as $skill) {
            if($skill['name'] != 'skill'){
                $thisSkill = Skill::where('entity_id','S' . Auth::user()->entity_id)
                            ->where('id', $skill['name'])
                            ->first();
                $thisSkill->skill = $skill['value'];
                $isSaved = $thisSkill->save();
            }else{
                $newSkill = new Skill();
                $newSkill->entity_id = 'S' . Auth::user()->entity_id; 
                $newSkill->skill =  $skill['value'];
                $isSaved = $newSkill->save();
            }

        }
        $success = ['error' => false, 'message' => 'Skilla edited successfully'];
        $fail = ['error' => true, 'message' => 'Something went wrong, could not save skill details'];
        return response()->json($isSaved ? $success  : $fail);
    }

    public function updateCourses(Request $request, School $school)
    {
        $courses = $request->courses;
        foreach ($courses as $course) {
            if($course['name'] != 'course'){
                $thiscourse = Course::where('entity_id', 'S' . Auth::user()->entity_id)
                            ->where('id', $course['name'])
                            ->first();
                $thiscourse->course = $course['value'];
                $isSaved = $thiscourse->save();
            }else{
                $newcourse = new Course();
                $newcourse->entity_id = 'S' . Auth::user()->entity_id; 
                $newcourse->course =  $course['value'];
                $isSaved = $newcourse->save();
            }

            $success = ['error' => false, 'message' => 'Courses edited successfully'];
        $fail = ['error' => true, 'message' => 'Something went wrong, could not save course details'];
        return response()->json($isSaved ? $success  : $fail);
        }
    }

    public function getTeachers($school_id)
    {
        $courses = Course::where('entity_id' , 'S' . $school_id )->get();
        $teacher_ids = [];
        $teachers = [];
        foreach ($courses as $course) {
             $teachercourses = Course::where('course' , $course->course)->get();
            foreach ($teachercourses as $teachercourse ) {
                if(substr($teachercourse->entity_id, 0, 1) == "T"){
                    $teacher_id = substr($teachercourse->entity_id, 1);
                    array_push($teacher_ids, $teacher_id);
                }
            }
        }

        $unique_ids = array_unique($teacher_ids);
        // dd($unique_ids);

        foreach ($unique_ids as $teacher_id) {
            $teacher = Teacher::where('id' , $teacher_id)->first();
            array_push($teachers, $teacher);
        }
        // dd($teachers);

        return $teachers;
    }

}
