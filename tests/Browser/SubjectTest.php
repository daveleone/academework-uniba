<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Teacher;

/**
* @group metto0
**/

class SubjectTest extends DuskTestCase
{
    protected $teacher;
    protected $baseUrl = 'http://127.0.0.1:8000';

    protected function setUp() : void
    {
        parent::setUp();

        $this->teacher = Teacher::factory()->create();
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
                ->waitForLocation($this->baseUrl . '/subjects')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    
    public function testTeacherCantCreateADuplicateSubject() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@add-subject-link')
                ->waitForText('Create New Subject')
                ->type('@create-subject-name', 'Test Subject')
                ->type('@create-subject-description', 'This is a test subject description')
                ->press('@submit-create-subject')
                ->waitForLocation($this->baseUrl . '/subjects')
                ->waitFor('@error-alert')
                ->assertVisible('@error-alert')
                ->click('@error-alert');
        });
    }

    public function testTeacherCanEditASubject() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@nde-edit-button')
                ->waitForText('Edit Test Subject')
                ->type('@edit-subject-name', 'Renamed Subject')
                ->type('@edit-subject-description', 'This is a renamed subject description')
                ->press('@submit-edit-subject')
                ->waitForLocation($this->baseUrl . '/subjects')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanDeleteASubject() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@nde-delete-button')
                ->press('@submit-delete-subject')
                ->waitForLocation($this->baseUrl . '/subjects')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanOpenASubject() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@add-subject-link')
                ->waitForText('Create New Subject')
                ->type('@create-subject-name', 'Test Subject')
                ->type('@create-subject-description', 'This is a test subject description')
                ->press('@submit-create-subject')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert')
                ->click('@nde-link')
                ->assertPathBeginsWith('/subject/');
        });
    }

    public function testTeacherCanCreateATopic()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('@add-topic-button')
                ->waitForText('Create New Topic')
                ->type('@create-topic-name', 'Test Topic')
                ->type('@create-topic-description', 'This is a test topic description')
                ->press('@submit-create-topic')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCantCreateADuplicateTopic() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->press('@add-topic-button')
                ->waitForText('Create New Topic')
                ->type('@create-topic-name', 'Test Topic')
                ->type('@create-topic-description', 'This is a test topic description')
                ->press('@submit-create-topic')
                ->waitFor('@error-alert')
                ->assertVisible('@error-alert')
                ->click('@error-alert');
        });
    }
    
    public function testTeacherCanEditATopic() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@nde-edit-button')
                ->waitForText('Edit Test Topic')
                ->type('@edit-topic-name', 'Renamed Topic')
                ->type('@edit-topic-description', 'This is a renamed topic description')
                ->press('@submit-edit-topic')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanDeleteATopic() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@nde-delete-button')
                ->press('@submit-delete-topic')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert');
        });
    }

    public function testTeacherCanOpenATopic() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->press('@add-topic-button')
                ->waitForText('Create New Topic')
                ->type('@create-topic-name', 'Test Topic')
                ->type('@create-topic-description', 'This is a test topic description')
                ->press('@submit-create-topic')
                ->waitFor('@success-alert')
                ->assertVisible('@success-alert')
                ->click('@success-alert')
                ->click('@nde-link')
                ->assertPathBeginsWith('/topic/');
        });
    }

}
