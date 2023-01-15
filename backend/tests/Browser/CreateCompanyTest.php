<?php

declare(strict_types=1);

namespace Tests\Browser;

use Database\Seeders\DepartmentSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Internships\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\TreeSelect;
use Tests\Browser\Pages\CompanyCreatePage;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class CreateCompanyTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRedirectGuestToLoginOnCompanyCreate(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit((new CompanyCreatePage())->url())
                ->assertPathIs((new LoginPage())->url());
        });
    }

    public function testUserCanCreateCompany(): void
    {
        $this->browse(function (Browser $browser): void {
            $this->seed(DepartmentSeeder::class);
            $user = User::factory()->create();
            $browser->loginAs($user);

            $browser->visit((new CompanyCreatePage())->url())
                ->waitUntilMissing("#nprogress")
                ->assertPathIs((new CompanyCreatePage())->url())
                ->type("name", "TestCompanyName")
                ->type("email", "company@example.com")
                ->type("phone_number", "000-000-000")
                ->type("url", env("APP_URL", "http://localhost"))
                ->press("@form_next")
                ->waitUntilMissing("#nprogress");

            $browser->waitUntilMissing("#nprogress")
                ->type("country", "Polska")
                ->type("voivodeship", "Dolnyśląsk")
                ->type("city", "Legnica")
                ->type("postal_code", "59-220")
                ->type("street", "Hutników 16")
                ->press("@company_form_set_marker")
                ->press("@form_next");

            $browser->within(new TreeSelect(), function ($browser): void {
                $browser->selectFirst(3);
            });

            $browser->press("@form_submit")
                ->waitUntilMissing("#nprogress")
                ->assertSee("TestCompanyName");

            $browser->logout();
        });
    }
}
