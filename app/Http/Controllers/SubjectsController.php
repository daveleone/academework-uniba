<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;

class SubjectsController extends Controller
{
    public function show(): View{
        $subjects = Subject::all(); // modificare per ogni teacher
        return view('subject', ['subjects' => $subjects]);
    }

    public function create(): View{
        Subject::create([
            'name' => Request()->input('SubName'),
            'description' => Request()->input('SubDescription'),
            'teacherId' => Auth::user()->id
        ]);
        return $this->show();
    }

    public function delete(): View{
        Subject::destroy(Request()->input('subId'));
        return $this->show();
    }

    public function edit(): View{
        $subject = Subject::find(Request()->input('subId'));
        $newName = Request()->input('subName'.$subject->id);
        $newDesc = Request()->input('subDesc'.$subject->id);

        if ($newName and $newName != ''){
            $subject->update(['name' => $newName]);
        }

        if ($newDesc and $newDesc != ''){
            $subject->update(['description' => $newDesc]);
        }

        return $this->show();
    }
}
