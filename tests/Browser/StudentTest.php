<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentTest extends DuskTestCase
{
    protected $student;
    protected $course;
    protected $quiz;
    protected $teacher;
    protected $baseUrl = 'http://127.0.0.1:8000';

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher = Teacher::factory()->create();


        $this->student = Student::factory()->create();


        $this->course = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
        ]);


        $this->quiz = Quiz::create([
            'name' => str()->random(4),
            'description' => 'This is a test quiz',
            'creator_id' => $this->teacher->user_id
        ]);


        $this->course->quizzes()->attach($this->quiz->id, [
            'start_time' => null,
            'duration_minutes' => null,
            'repeatable' => false
        ]);

        $this->course->students()->attach($this->student->id);
    }

    /** @test */
    public function studentCanViewAvailableQuizzes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->student->user->email)
                ->type('password', 'password')  // Assicurati che questo sia la password corretta
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . '/student/classes')
                ->assertSee('Your Classes')
                ->waitForText('View class')
                ->press('@view-class')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises")
                ->assertSee($this->quiz->name)
                ->click('@dropdown')
                ->click('@logout-button')
                ->assertSee('Master the Knowledge');
        });
    }

    /** @test */
    public function studentCanStartAquiz()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->student->user->email)
                ->type('password', 'password')  // Assicurati che questo sia la password corretta
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . "/student/classes/{$this->course->id}/exercises")
                ->waitFor('@start-quiz', 10)
                ->click('@start-quiz')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises/{$this->quiz->id}/start")
                ->click('@dropdown')
                ->click('@logout-button')
                ->assertSee('Master the Knowledge');
        });
    }

    /** @test */

    public function studentCanSubmitQuiz()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->student->user->email)
                ->type('password', 'password')  // Assicurati che questo sia la password corretta
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . "/student/classes/{$this->course->id}/exercises")
                ->waitFor('@start-quiz', 10)
                ->click('@start-quiz')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises/{$this->quiz->id}/start")
                ->press('@submit-exam')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises")
                ->assertSee('Success!')
                ->click('@dropdown')
                ->click('@logout-button')
                ->assertSee('Master the Knowledge');
        });
    }

    /** @test */
    public function studentCannotSubmitQuizAlreadyTaken()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->student->user->email)
                ->type('password', 'password')  // Assicurati che questo sia la password corretta
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . "/student/classes/{$this->course->id}/exercises")
                ->waitFor('@start-quiz', 10)
                ->click('@start-quiz')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises/{$this->quiz->id}/start")
                ->press('@submit-exam')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises")
                ->assertSee('Success!')
                ->assertAttribute('@disabled-link', 'aria-disabled', 'true')
                ->assertPathIs("/student/classes/{$this->course->id}/exercises")
                ->click('@dropdown')
                ->click('@logout-button')
                ->assertSee('Master the Knowledge');
        });
    }
}
