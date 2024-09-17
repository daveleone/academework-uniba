<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CourseTest extends DuskTestCase
{

    protected $teacher;
    protected $student;
    protected $course;
    protected $baseUrl = 'http://127.0.0.1:8000';

    protected function setUp(): void
    {
        parent::setUp();

        // Create a teacher
        $this->teacher = Teacher::factory()->create();

        // Create a student
        $this->student = Student::factory()->create();

        // Create a course
        $this->course = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
        ]);
    }

    /** @test */
    public function testTeacherCanViewCoursesPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->teacher->user->email)
                ->type('password', 'password')  // Assicurati che questo sia la password corretta
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit($this->baseUrl . '/classes')
                ->assertSee('Your Classes');
        });
    }

    public function testTeacherCanCreateACourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/classes')
                ->click('@create-class-link')
                ->waitForText('Create New Class')
                ->type('@create-class-name', 'Test Course')
                ->type('@create-class-description', 'This is a test course description')
                ->press('@create-class')
                ->waitForLocation($this->baseUrl . '/classes')
                ->assertSee('Test Course');
        });
    }

    public function testTeacherCanEditCourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/classes/{$this->course->id}")
                ->waitForText('Edit class')
                ->type('@class-name', 'Test Edit Course')
                ->type('@class-description', 'This is a test to edit course description')
                ->press('@update-class')
                ->waitForLocation($this->baseUrl . "/classes/{$this->course->id}")
                ->assertValue('#course_name', 'Test Edit Course')
                ->assertValue('#course_description', 'This is a test to edit course description');
        });
    }

    public function testStudentCanBeAddedToCourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . "/classes/{$this->course->id}")
                ->click('@add-student')
                ->assertPathIs("/student/{$this->course->id}")
                ->assertSee($this->student->user->name)
                ->check("@add-student-checkbox")
                ->press('@add-student-button')
                ->assertPathIs("/classes/{$this->course->id}")
                ->waitForText('Success!');
        });
    }
}
