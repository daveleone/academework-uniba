<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CheckFormTest extends DuskTestCase
{
    public function testFormElements()
    {
        $this->browse(function ($browser) {
            $browser->visit('http://127.0.0.1:8000/login')
            ->waitForLocation('/login')
            ->assertSee('Email')
            ->type('email', 'pepperdanilo@gmail.com')
            ->type('password', '00000000')
            ->click('button[type="submit"]');

        });
    }

}

