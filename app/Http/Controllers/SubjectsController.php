<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function show(): View
    {
        return view('teacher.view-subjects');
    }

    public function make(): View
    {
        return view('teacher.create-subjects');
    }
}
