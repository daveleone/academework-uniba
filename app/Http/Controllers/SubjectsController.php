<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubjectsController extends Controller
{
    public function show(): View
    {
        $subjects = Subject::where('teacher_id', Auth::user()->id)->get();  // modificare
        return view('subjects', ['subjects' => $subjects]);
    }

    public function create(): View
    {
        Subject::create([
            'name' => Request()->input('SubName'),
            'description' => Request()->input('SubDescription'),
            'teacher_id' => Auth::user()->id
        ]);
        return $this->show();
    }

    public function delete(): View
    {
        Subject::destroy(Request()->input('subId'));
        return $this->show();
    }

    public function edit(): View
    {
        $subject = Subject::find(Request()->input('subId'));
        $newName = Request()->input('subName' . $subject->id);
        $newDesc = Request()->input('subDesc' . $subject->id);

        if ($newName and $newName != '') {
            $subject->update(['name' => $newName]);
        }

        if ($newDesc and $newDesc != '') {
            $subject->update(['description' => $newDesc]);
        }
        return $this->show();
    }
}
