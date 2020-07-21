<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceStudent;
use App\Subject;
use App\SubjectStudent;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        $attendances =  Attendance::whereHas('subject', function ($e){
            return $e->where('lecturer_id' , auth()->id());
        })->paginate(9);

        return view('attendance.index', compact('attendances'));
    }

    public function getStudent($subject_id){
        return SubjectStudent::with('user')->where(['subject_id' => $subject_id])->get()->pluck('user.staff_id');
    }

    public function create(){
        $subjects = Subject::where('lecturer_id', auth()->id())->get();

        return view('attendance.create', compact('subjects'));
    }

    public function store(Request $request){
        $class = Attendance::create([
            'subject_id' => $request->subject_id,
            'status' => 0,
            'class_date' => $request->prefix__date__suffix
        ]);

        $subject_students = SubjectStudent::where('subject_id', $request->subject_id)->pluck('student_id');
        foreach ($subject_students as $student_id){
            AttendanceStudent::create([
                'student_id' => $student_id,
                'class_id' => $class->id,
                'is_attend' => 0
            ]);
        }

        return back()->withStatus(__('Class successfully created.'));
    }

    public function isAttend(Request $request){
        $user = User::where('staff_id', $request->student_id)->first();
        $attendance =  AttendanceStudent::where('class_id', $request->class_id)->where('student_id', $user->id)->first();
        $attendance->update([
            'is_attend' => 1
        ]);

        return response($request->student_id, 200);
    }

    public function show($class_id){
        $class = Attendance::with('subject')->findOrFail($class_id)->get();
        return view('attendance.show', compact('class'));
    }

    public function live($class_id){
        $class = Attendance::with('subject')->findOrFail($class_id)->first();

        return view('attendance.live', compact('class'));
    }
}
