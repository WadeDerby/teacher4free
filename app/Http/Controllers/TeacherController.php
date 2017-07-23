<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use App\Skill;
use App\Course;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::where('username', Auth::user()->username)->first();
        // dd($teacher);
        return view('teacher.dashboard', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register.teacher');
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
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function home(Teacher $teacher)
    {
        return view('teacher.home');
    }

    public function profile(Teacher $teacher)
    {
        $teacher = Teacher::where('username', Auth::user()->username)->first();
        Carbon::parse($teacher->date_of_birth);
        $date = $teacher->date_of_birth->toDateString();
        return view('teacher.profile' , compact('teacher' , 'date'));
    }
    public function skills(Teacher $teacher)
    {
        $skills = Skill::where('teacher_id', Auth::user()->entity_id)->get();
        $teacher = Teacher::where('id', Auth::user()->entity_id)->first();
        // dd($skills);

        return view('teacher.skills', compact('skills', 'teacher'));
    }
    public function courses(Teacher $teacher)
    {
        $courses = Course::where('teacher_id', Auth::user()->entity_id)->get();
        $teacher = Teacher::where('id', Auth::user()->entity_id)->first();
        return view('teacher.courses',compact('courses', 'teacher'));
    }
    public function qualification(Teacher $teacher)
    {
        return view('teacher.qualification');
    }
    public function timeline(Teacher $teacher)
    {
        return view('teacher.timeline');
    }
    public function messages(Teacher $teacher)
    {
        return view('teacher.messages');
    }
    public function settings(Teacher $teacher)
    {
        return view('teacher.settings');
    }
    public function search(Request $request)
    {
        dd($request->all());
        // return view('teacher.search');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, Teacher $teacher)
    {
        $teacher = Teacher::where('username', Auth::user()->username)->first();
        $user = User::where('username', Auth::user()->username)->first();
        $teacher->name =  $request->name;
        $teacher->username = $user->username  = $request->username;
        $teacher->institution = $request->phone;
        $teacher->phone = $request->school;
        $teacher->email = $request->email;
        $teacher->date_of_birth = $request->date;
        $teacherSaved = $teacher->save();
        $userSaved = $user->save();

        $success = ['error' => false, 'message' => 'User edited successfully'];
        $fail = ['error' => true, 'message' => 'Something went wrong, could not save user details']; 

        if( $teacherSaved && $userSaved ){
         return response()->json($success);   
        }else{
            return response()->json($fail);
        }
               
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function updateSkills(Request $request, Teacher $teacher)
    {
        $skills = $request->skills;
        foreach ($skills as $skill) {
            if($skill['name'] != 'skill'){
                $thisSkill = Skill::where('teacher_id', Auth::user()->entity_id)
                            ->where('id', $skill['name'])
                            ->first();
                $thisSkill->skill = $skill['value'];
                $thisSkill->save();
            }else{
                $newSkill = new Skill();
                $newSkill->teacher_id = Auth::user()->entity_id; 
                $newSkill->skill =  $skill['value'];
                $newSkill->save();
            }

            
        }
    }

    public function updateCourses(Request $request, Teacher $teacher)
    {
        $courses = $request->courses;
        foreach ($courses as $course) {
            if($course['name'] != 'course'){
                $thiscourses = Course::where('teacher_id', Auth::user()->entity_id)
                            ->where('id', $courses['name'])
                            ->first();
                $thiscourse->course = $course['value'];
                $thiscourse->save();
            }else{
                $newcourse = new Course();
                $newcourse->teacher_id = Auth::user()->entity_id; 
                $newcourse->course =  $course['value'];
                $newcourse->save();
            }

            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
