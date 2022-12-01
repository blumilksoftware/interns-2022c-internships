<?php

declare(strict_types=1);

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Internships\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CompanyCreatePage;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\RegisterPage;
use Tests\Browser\Pages\VerifyEmailPage;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function visitRegisterPageAndFillFields(Browser $browser): void
    {
        $browser->visit((new RegisterPage())->url())
            ->type("first_name", "ExampleName")
            ->type("last_name", "ExampleSurname")
            ->type("email", "test@example.com")
            ->type("password", "password123")
            ->type("password_confirmation", "password123");
    }

    public function testGuestCanCreateAccount(): void
    {
        $this->browse(function (Browser $browser): void {
            $this->visitRegisterPageAndFillFields($browser);
            $browser->press("@register-submit")
                ->waitUntilMissing("#nprogress")
                ->assertPathIs((new HomePage())->url());

            $user = User::where("email", "test@example.com")->first();
            $browser->assertAuthenticatedAs($user)
                ->logout();
        });
    }

    public function testNewUserNeedsToVerifyAccount(): void
    {
        $this->browse(function (Browser $browser): void {
            $this->visitRegisterPageAndFillFields($browser);
            $browser->press("@register-submit")
                ->waitUntilMissing("#nprogress");

            $browser->visit((new CompanyCreatePage())->url())
                ->waitUntilMissing("#nprogress")
                ->assertPathIs((new VerifyEmailPage())->url())
                ->logout();
        });
    }

    public function testGuestCantRegisterWithExistingEmail(): void
    {
        $this->browse(function (Browser $browser): void {
            $user = User::factory()->create();

            $this->visitRegisterPageAndFillFields($browser);
            $browser->type("email", $user->email);

            $browser->press("@register-submit")
                ->waitUntilMissing("#nprogress")
                ->assertVue("message", "validation.unique", "@error-message");
        });
    }

    public function testGuestCantRegisterWithUnconfirmedPassword(): void
    {
        $this->browse(function (Browser $browser): void {
            $this->visitRegisterPageAndFillFields($browser);
            $browser->type("password_confirmation", "wrongpassword");

            $browser->press("@register-submit")
                ->waitUntilMissing("#nprogress")
                ->assertVue("message", "validation.confirmed", "@error-message");
        });
    }
}
