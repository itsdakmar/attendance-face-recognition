<?php

namespace App\Http\Controllers;

use App\StudentImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function profile(){
        $student = User::with('studentImages')->findOrFail(auth()->id());
        return view('students.profile', compact('student'));
    }

    public function store(Request $request){
        $binary_data = base64_decode( $request->img );
        $file_name = uniqid().'.jpg';
        $directory = $_SERVER['DOCUMENT_ROOT'].'/argon'."/student/img/".auth()->user()->staff_id;
        if(!File::exists($directory)) {
            File::makeDirectory($directory, 777, true);
        }

        $result = file_put_contents( $directory.'/'.$file_name, $binary_data );

         StudentImage::updateOrCreate(
            ['user_id' => auth()->id()],
            ['path' => $file_name]
        );

        return back()->withStatus(__('Successfully update profile.'));
    }

    public function getImage($student_id){
        $path = User::where('staff_id', $student_id)->with('studentImages')->get()->pluck('studentImages.path')->first();
        return response()->file(public_path('argon').'/student/img/'.$student_id.'/'.$path);
    }
}
