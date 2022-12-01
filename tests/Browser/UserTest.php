<?php

declare(strict_types=1);

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Internships\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\RegisterPage;
use Tests\Browser\Pages\CompanyCreatePage;
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
                ->waitUntilMissing('#nprogress')
                ->assertAuthenticatedAs($this->user)
                ->assertPathIs((new HomePage())->url())
                ->logout();
        });
    }

    public function testGuestCanCreateAccount(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit((new RegisterPage())->url())
                ->type("first_name", "first_name")
                ->type("last_name", "last_name")
                ->type("email", "test_" . $this->user->email)
                ->type("password", "password123")
                ->type("password_confirmation", "password123")
                ->press("@register-submit")
                ->waitUntilMissing('#nprogress')
                ->assertPathIs((new HomePage())->url());

            $user = User::where('email',"test_" . $this->user->email)->first();
            $browser->assertAuthenticatedAs($user)
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
                ->waitUntilMissing('#nprogress')
                ->assertPathIs((new LoginPage())->url())
                ->assertVue("message", "auth.failed", "@error-message");
        });
    }

    public function testRedirectGuestToLoginOnAuthRequiredPage(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit((new CompanyCreatePage())->url())
                ->assertPathIs((new LoginPage())->url());
        });
    }
}
