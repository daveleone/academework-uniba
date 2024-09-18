<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testLoginWithInvalidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitForLocation('/login')
                ->type('email', 'wrong@example.com')
                ->type('password', 'wrongpassword')
                ->click('button[type="submit"]')
                ->assertPathIs('/login')
                ->assertSee('These credentials do not match our records.');
        });
    }


    public function testLoginWithValidCredentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser){
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitForLocation('/login')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->assertPathIs('/dashboard');
        });

        $user->delete();
    }
}
