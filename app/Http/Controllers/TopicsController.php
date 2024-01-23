<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\Subject;
use App\Models\Topic;


class TopicsController extends Controller
{
    public function show($id): View{
        $subject = Subject::find($id);
        $topics = Topic::where('subjectId', $subject->id)->get();
        return view('topics', ['subject' => $subject, 'topics' => $topics]);
    }

    public function create($id): View{
        $subject = Subject::find($id);
        if($subject){
            Topic::create([
                'name' => Request()->input('TopicName'),
                'description' => Request()->input('TopicDescription'),
                'subjectId' => $subject->id
            ]);
        }
        return $this->show($id);
    }

    public function delete($id): View{
        Topic::destroy(Request()->input('topId'));
        return $this->show($id);
    }

    public function edit($id): View{
        $topic = Topic::find(Request()->input('topId'));
        $newName = Request()->input('topName'.$topic->id);
        $newDesc = Request()->input('topDesc'.$topic->id);

        if ($newName and $newName != ''){
            $topic->update(['name' => $newName]);
        }

        if ($newDesc and $newDesc != ''){
            $topic->update(['description' => $newDesc]);
        }
        return $this->show($id);
    }
}
