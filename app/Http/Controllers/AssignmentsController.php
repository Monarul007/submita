<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentFile;
use App\Models\Submission;
use App\Models\SubmitedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssignmentsController extends Controller
{
    public function create(Request $request){

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'due-dates' => 'required',
                'files' => 'nullable|mimes:pdf,docx,jpg,jpeg,png',
            ]);

            $assignment = Assignment::create([
                'name' => $request['name'],
                'instructions' => $request['instructions'],
                'expire_at' => $request['due-dates'],
                'user_id' => Auth::id()
            ]);

            if ($request->hasfile('files')) {
                $images = $request->file('files');
                foreach($images as $image) {
                    $name = $image;
                    $basename = basename($name);
                    $extension = $image->getClientOriginalExtension();
                    $filename = $basename.time().'.'.$extension;
                    $path = $image->storeAs('images/assignment-files', $filename, 'public');
                    AssignmentFile::create([
                        'file' => $filename,
                        'assignment_id' => $assignment->id,
                        'user_id' => Auth::id()
                    ]);
                }
            }

            return redirect('/user/assignment/create')->with('flash_message_success', 'Assignment Created Successfully!');
        }

        return view('assignments.create');
    }

    public function submit(Request $request){

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'IHSB_no' => 'required',
                'class' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'section' => 'required',
                'gender' => 'required',
                'files' => 'nullable|mimes:pdf,docx,jpg,jpeg,png',
            ]);

            $submission = Submission::create([
                'std_id' => $request['IHSB_no'],
                'class' => $request['class'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'section' => $request['section'],
                'gender' => $request['gender'],
                'birth_date' => $request['birth_date'],
                'message' => $request['message'],
                'user_id' => Auth::id()
            ]);

            if ($request->hasfile('files')) {
                $images = $request->file('files');
                foreach($images as $image) {
                    $name = $image;
                    $extension = $image->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $path = $image->storeAs('images/submited-files', $filename, 'public');
                    SubmitedFile::create([
                        'file' => $filename,
                        'submission_id' => $submission->id,
                        'user_id' => Auth::id()
                    ]);
                }
            }

            return redirect('/user/assignment/submit')->with('flash_message_success', 'You have successfully submited your assignment!');
        }

        return view('assignments.submit');
    }

    public function assignments(){
        $user = Auth::id();
        $assignments = Assignment::where('user_id', $user)->get();
        return view('assignments.assignments')->with(compact('assignments'));
    }
}
