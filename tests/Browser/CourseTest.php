<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CourseTest extends DuskTestCase
{
    /** @test */
    public function testTeacherCanViewCoursesPage()
    {
        $user = User::factory()->create();
        $teacher = Teacher::create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitForLocation('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->visit('http://127.0.0.1:8000/classes')
                ->assertSee('Your Classes');
        });
    }

    public function testTeacherCanCreateACourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@create-class-link')
                ->waitForText('Create New Class')
                ->type('@create-class-name', 'Test Course')
                ->type('@create-class-description', 'This is a test course description')
                ->press('@create-class')
                ->waitForLocation('http://127.0.0.1:8000/classes')
                ->assertSee('Test Course');
        });
    }

    public function testTeacherCanEditCourse()
    {
        $user = User::factory()->create();
        $teacher = Teacher::create(['user_id' => $user->id]);
        $course = Course::create(['teacher_id' => $teacher->id, 'course_name' => 'Original Course', 'course_description' => 'Original Description']);


        $this->actingAs($user)->browse(function (Browser $browser) use ($course) {
            $browser->visit("http://127.0.0.1:8000/classes/{$course->id}")
                ->waitForText('Edit class')
                ->type('@class-name', 'Test Edit Course')
                ->type('@class-description', 'This is a test to edit course description')
                ->press('@update-class')
                ->waitForLocation("http://127.0.0.1:8000/classes/{$course->id}")
                ->assertValue('#course_name', 'Test Edit Course')
                ->assertValue('#course_description', 'This is a test to edit course description');
        });
    }
}
