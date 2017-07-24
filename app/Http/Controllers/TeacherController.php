<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use App\Qualification;
use App\Skill;
use App\School;
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
        $schools = $this->getSchools(Auth::user()->entity_id);
        return view('teacher.dashboard', compact('teacher', 'schools'));
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
       $teacher = Teacher::where('username', Auth::user()->username)->first();
        $schools = $this->getSchools(Auth::user()->entity_id);
        return view('teacher.home', compact('teacher', 'schools'));
    }

    public function profile(Teacher $teacher)
    {
        $teacher = Teacher::where('username', Auth::user()->username)->first();
        // Carbon::parse($teacher->date_of_birth);
        $date = $teacher->date_of_birth->toDateString();
        return view('teacher.profile' , compact('teacher' , 'date'));
    }
    public function skills(Teacher $teacher)
    {
        $skills = Skill::where('entity_id', 'T' . Auth::user()->entity_id)->get();
        $teacher = Teacher::where('id', Auth::user()->entity_id)->first();
        // dd($skills);

        return view('teacher.skills', compact('skills', 'teacher'));
    }
    public function courses(Teacher $teacher)
    {
        $courses = Course::where('entity_id', 'T' . Auth::user()->entity_id)->get();
        $teacher = Teacher::where('id', Auth::user()->entity_id)->first();
        return view('teacher.courses',compact('courses', 'teacher'));
    }
    public function qualification(Teacher $teacher)
    {
        $teacher = Teacher::where('id', Auth::user()->entity_id)->first();
        $qualification = Qualification::where('teacher_id', Auth::user()->entity_id)->first();
        return view('teacher.qualification' , compact('qualification', 'teacher'));
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
                $thisSkill = Skill::where('entity_id','T' . Auth::user()->entity_id)
                            ->where('id', $skill['name'])
                            ->first();
                $thisSkill->skill = $skill['value'];
                $thisSkill->save();
            }else{
                $newSkill = new Skill();
                $newSkill->entity_id = 'T' . Auth::user()->entity_id; 
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
                $thiscourse = Course::where('entity_id', 'T' . Auth::user()->entity_id)
                            ->where('id', $course['name'])
                            ->first();
                $thiscourse->course = $course['value'];
                $thiscourse->save();
            }else{
                $newcourse = new Course();
                $newcourse->entity_id = 'T' . Auth::user()->entity_id; 
                $newcourse->course =  $course['value'];
                $newcourse->save();
            }

            
        }
    }

    public function updateQualification(Request $request)
    {
        $teacher = Teacher::where('username', Auth::user()->username)->first();
        $qualification = Qualification::where('teacher_id' ,$teacher->id)->get();

        if($qualification->count() > 0){

            $qualification->experience = $request->experience;
            $qualification->degree = $request->degree; 
            $qualification->course = $request->course;
            $qualification->institution = $request->institution;

            $isSaved = $qualification->save();
        }else{
            $newQualification = new Qualification();

            $newQualification->teacher_id = $teacher->id;
            $newQualification->experience = $request->experience;
            $newQualification->degree = $request->degree; 
            $newQualification->course = $request->course;
            $newQualification->institution = $request->institution; 

           $isSaved = $newQualification->save();
        }

        $success = ['error' => false, 'message' => 'Qualification saved successfully'];
        $fail = ['error' => true, 'message' => 'Something went, couldnt save qualification'];

        return response()->json($isSaved ? $success  : $fail);

        


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $school_ids = $this->getSchools(Auth::user()->entity_id);
        dd($school_ids);
    }


    public function getSchools($teacher_id)
    {
        $courses = Course::where('entity_id' , 'T' . $teacher_id )->get();
        $school_ids = [];
        $schools = [];
        foreach ($courses as $course) {
             $schoolcourses = Course::where('course' , $course->course)->get();
            foreach ($schoolcourses as $schoolcourse ) {
                if(substr($schoolcourse->entity_id, 0, 1) == "S"){
                    $school_id = substr($schoolcourse->entity_id, 1);
                    array_push($school_ids, $school_id);
                }
            }
        }

        $unique_ids = array_unique($school_ids);

        foreach ($unique_ids as $school_id) {
            $school = School::where('id' , $school_id)->first();
            array_push($schools, $school);
        }

        return $schools;
    }
}
