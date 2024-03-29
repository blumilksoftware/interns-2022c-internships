<?php

declare(strict_types=1);

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Internships\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testGuestCanLogin(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit((new LoginPage())->url())
                ->type("email", $this->user->email)
                ->type("password", "password");

            $browser->press("@login-submit")
                ->waitUntilMissing("#nprogress")
                ->assertAuthenticatedAs($this->user)
                ->assertPathIs((new HomePage())->url())
                ->logout();
        });
    }

    public function testGuestCantLoginWithWrongPassword(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit((new LoginPage())->url())
                ->type("email", $this->user->email)
                ->type("password", "wrongpassword");

            $browser->press("@login-submit")
                ->waitUntilMissing("#nprogress")
                ->assertPathIs((new LoginPage())->url())
                ->assertVue("message", "auth.failed", "@error-message");
        });
    }
}
