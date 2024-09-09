<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;


class TopicsController extends Controller
{
    public function show($id): View | RedirectResponse{
        $subject = Subject::find($id); //TODO: autorizzare l'utente ?
        if (!$subject) {
            session()->flash('error', 'Subject not found');
            return to_route('subject.show');
        }

        $topics = $subject->topics;
        return view('topics', ['subject' => $subject, 'topics' => $topics]);
    }

    public function create($id): RedirectResponse{
        $subject = Subject::find($id);
        if($subject){
            try{
                Topic::create([
                    'name' => Request()->input('TopicName'),
                    'description' => Request()->input('TopicDescription'),
                    'subject_id' => $subject->id
                ]);
                session()->flash('success', Request()->input('TopicName') . ' created');
            } catch(\Exception $e){
                session()->flash('error', $e->getMessage());
            }
        } else {
            session()->flash('error', 'Subject not found');
            return to_route('subject.show');
        }
        return to_route('subject.topics', ['id' => $id]);
    }

    public function delete($id): RedirectResponse{
        try {
            Topic::destroy(Request()->input('topId'));
            session()->flash('success', 'Topic deleted');
            return to_route('subject.topics', ['id' => $id]);
        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
            return to_route('subject.show');
        }
    }

    public function edit($id): RedirectResponse{
        $topic = Topic::find(Request()->input('topId'));

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        try {
            $newName = Request()->input('topName'.$topic->id);
            $newDesc = Request()->input('topDesc'.$topic->id);

            if ($newName and $newName != ''){
                $topic->update(['name' => $newName]);
            }

            if ($newDesc and $newDesc != ''){
                $topic->update(['description' => $newDesc]);
            }
            session()->flash('success', 'Topic updated');
            return to_route('subject.topics', ['id' => $id]);
        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
            return to_route('subject.show');
        }
    }
}
