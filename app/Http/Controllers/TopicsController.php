<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\Subject;
use App\Models\Topic;


class TopicsController extends Controller
{
    public function show($id): View{
        $subject = Subject::find($id); //autorizzare l'utente
        $topics = $subject->topics;
        return view('topics', ['subject' => $subject, 'topics' => $topics]);
    }

    public function create($id): View{
        $subject = Subject::find($id); //autorizzare l'utente
        if($subject){
            Topic::create([
                'name' => Request()->input('TopicName'),
                'description' => Request()->input('TopicDescription'),
                'subject_id' => $subject->id
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
