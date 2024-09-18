<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SubjectsController extends Controller
{
    public function show(): View
    {
        $subjects = Subject::where('teacher_id', Auth::user()->id)->paginate(8);
        return view('subjects', ['subjects' => $subjects]);
    }

    public function create(): RedirectResponse
    {
        try {
            Subject::create([
                'name' => Request()->input('SubName'),
                'description' => Request()->input('SubDescription'),
                'teacher_id' => Auth::user()->id
            ]);
            session()->flash('success', Request()->input('SubName') . ' created');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return to_route('subject.show');
    }

    public function delete(): RedirectResponse
    {
        try {
            Subject::where('teacher_id', Auth::user()->id)
                ->where('id', Request()
                ->input('subId'))
                ->first()
                ->delete();
            session()->flash('success', 'Subject deleted');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return to_route('subject.show');
    }

    public function edit(): RedirectResponse
    {
        $subject = Subject::where('teacher_id', Auth::user()->id)
                    ->where('id', Request()
                    ->input('subId'))
                    ->first();

        if (!$subject) {
            session()->flash('error', 'Subject not found');
            return to_route('subject.show');
        }

        try{
            $newName = Request()->input('subName' . $subject->id);
            $newDesc = Request()->input('subDesc' . $subject->id);

            if ($newName and $newName != '') {
                $subject->update(['name' => $newName]);
            }

            if ($newDesc and $newDesc != '') {
                $subject->update(['description' => $newDesc]);
            }
            session()->flash('success', 'Subject updated');

        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return to_route('subject.show');
    }
}
