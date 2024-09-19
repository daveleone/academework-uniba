<?php

namespace Tests\Browser;

use App\Models\Exercise;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Topic;


/**
* @group metto
**/

class ExerciseTest extends DuskTestCase
{

    protected $teacher;
    protected $subject;
    protected $topic;
    protected $baseUrl = 'http://127.0.0.1:8000';


    private function createModels(){
        $this->teacher = Teacher::find(1);
        if(!$this->teacher){
            $this->teacher = Teacher::factory()->create();
        }

        $this->subject = Subject::find(1);
        if(!$this->subject){
            $this->subject = Subject::factory([
                'teacher_id' => $this->teacher->user_id,
            ])->create();
        }

        $this->topic = Topic::find(1);
        if(!$this->topic){
            $this->topic = Topic::factory([
                'subject_id' => $this->subject->id,
            ])->create();
        }
    }
    
    protected function setUp() : void
    {
        parent::setUp();
        $this->createModels();
       
    }

    /** @test */
    public function testTeacherCanViewExercisesPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->teacher->user->email)
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . "/topic/" . $this->topic->id)
                ->assertPathIs('/topic/' . $this->topic->id);
        });
    }

    public function testTeacherCanCreateOpenExercise(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->press('@create-exercise-button')
                ->waitForText('Create New Exercise')
                ->type('@create-exercise-name', "My Open Exercise")
                ->type('@create-exercise-description', "My Open Exercise description")
                ->type('@create-exercise-points', "3")
                ->select('@create-exercise-type', "open")
                ->press('@create-exercise-submit')
                ->assertPathIs("/exercise-creator")
                ->type('@open-answer-create', "My answer is this text")
                ->press('@open-create-submit')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanCreateTfExercise(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/topic/" . $this->topic->id)
                ->assertPathIs('/topic/' . $this->topic->id)
                ->press('@create-exercise-button')
                ->waitForText('Create New Exercise')
                ->type('@create-exercise-name', "My True False Exercise")
                ->type('@create-exercise-description', "My True False Exercise description")
                ->type('@create-exercise-points', "5")
                ->select('@create-exercise-type', "true/false")
                ->press('@create-exercise-submit')
                ->assertPathIs("/exercise-creator")
                ->type('@tf-quest-create', "My answer is this text")
                ->press('@tf-create-submit')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }
    
    public function testTeacherCanCreateClosedExercise(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/topic/" . $this->topic->id)
                ->assertPathIs('/topic/' . $this->topic->id)
                ->press('@create-exercise-button')
                ->waitForText('Create New Exercise')
                ->type('@create-exercise-name', "My Closed Exercise")
                ->type('@create-exercise-description', "My Closed Exercise description")
                ->type('@create-exercise-points', "1")
                ->select('@create-exercise-type', "close")
                ->press('@create-exercise-submit')
                ->assertPathIs("/exercise-creator")
                ->type('@close-ans-create', "My closed answer is this text")
                ->radio('isTrue', '0')
                ->press('@closed-create-submit')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanCreateFillInExercise(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/topic/" . $this->topic->id)
                ->assertPathIs('/topic/' . $this->topic->id)
                ->press('@create-exercise-button')
                ->waitForText('Create New Exercise')
                ->type('@create-exercise-name', "My Fill In Exercise")
                ->type('@create-exercise-description', "My Fill In Exercise description")
                ->type('@create-exercise-points', "8")
                ->select('@create-exercise-type', "fill-in")
                ->press('@create-exercise-submit')
                ->assertPathIs("/exercise-creator")
                ->press('@add-text-buttn')
                ->press('@add-input-buttn')
                ->type('element0', 'This Exercise is fill')
                ->type('element1', 'In')
                ->press('@fill-create-submit')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }
    
    public function testTeacherCanCreateQuiz(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/quizzes")
                ->assertPathIs('/quizzes')
                ->press('@create-quiz-button')
                ->waitForText('Create New Quiz')
                ->type('@create-quiz-name', "My Quiz")
                ->type('@create-quiz-description', "My Quiz description")
                ->press('@create-quiz-submit')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanAddExToQuiz(): void
    {
        $this->browse(function (Browser $browser) {
            $topics = Topic::with('subject')
               ->whereHas('subject', function ($query) {
                   $query->where('teacher_id', $this->teacher->user_id);
               })
               ->get();

            $exercises = Exercise::join('topics', 'topics.id', '=', 'exercises.topic_id')
                 ->whereIn('topics.id', $topics->pluck('id')->toArray()) // Filtra per gli ID dei topic
                 ->select('exercises.*', 'topics.name as topic_name')
                 ->get();
            foreach($exercises as $exercise){
                $browser->visit($this->baseUrl . "/exercise/" . $exercise->id)
                    ->assertPathIs("/exercise/" . $exercise->id)
                    ->press('@add-to-quiz-button')
                    ->check('checkbox-quiz-0')
                    ->press('@add-to-quiz-submit')
                    ->waitFor('@success-alert')
                    ->assertVisible('@success-alert')
                    ->click('@success-alert');
            }
        });
    }

    public function testTeacherCanViewQuiz(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/quizzes")
                ->assertPathIs('/quizzes')
                ->click('@nde-link')
                ->assertPathBeginsWith('/quiz/');
        });
    }
}
