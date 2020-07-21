<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Subject;
use App\SubjectStudent;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $subjects = Subject::all();
        if(auth()->user()->roles->first()->name == 'lecturer') $subjects->where('lecturer_id', auth()->id());

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        Subject::create($request->merge(['lecturer_id' => auth()->id()])->all());
        return back()->withStatus(__('Subject successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enroll(Request $request){

        SubjectStudent::create([
            'subject_id' => $request->subject_id,
            'student_id' => auth()->id(),
        ]);

        $subject = Subject::find($request->subject_id)->first();

        return response($subject->code.' '.$subject->name, '200');
    }
}
