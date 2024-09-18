<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Teacher;
use App\Models\Subject;

class SubjectTest extends DuskTestCase
{
    protected $teacher;
    protected $subject;
    protected $baseUrl = 'http://127.0.0.1:8000';

    protected function setUp() : void
    {
        parent::setUp();

        $this->teacher = Teacher::factory()->create();
        // $this->subject = Subject::factory()->create([
        //     'teacher_id' => $this->teacher->id,
        // ]);
    }
    
    /** @test */
    public function testTeacherCanViewSubjectsPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/login')
                ->type('email', $this->teacher->user->email)
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->waitForLocation('/dashboard')
                ->clickLink('My subjects')
                ->assertSee('Subjects');
        });
    }

    /** @test */
    public function testTeacherCanCreateASubject()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->baseUrl . '/subjects')
                ->click('@add-subject-link')
                ->waitForText('Create New Subject')
                ->type('@create-subject-name', 'Test Subject')
                ->type('@create-subject-description', 'This is a test subject description')
                ->press('@submit-create-subject')
                ->waitForLocation($this->baseUrl . '/subject')
                ->assertSee('Test Subject');
        });
    }
}
