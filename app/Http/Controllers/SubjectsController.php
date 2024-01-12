<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class SubjectsController extends Controller
{
    public function show(): View
    {
        $subjects = Subject::all();
        return view('subject', ['subjects' => $subjects]);
    }

    public function create(): View{
        Subject::create([
            'name' => Request()->get('SubName'),
            'description' => Request()->get('SubDescription'),
            'teacherId' => Auth::user()->id
        ]);
        return $this->show();
    }

    public function topics($id): View{
        $subject = Subject::find($id);
        return view('topics', ['subject' => $subject]);
    }
}
