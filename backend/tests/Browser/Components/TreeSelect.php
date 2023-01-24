<?php

declare(strict_types=1);

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class TreeSelect extends BaseComponent
{
    public function selector(): string
    {
        return ".vue-treeselect";
    }

    public function assert(Browser $browser): void
    {
        $browser->assertVisible($this->selector());
    }

    public function elements(): array
    {
        return [
            "@container" => ".vue-treeselect__value-container",
            "@menu" => ".vue-treeselect__menu",
            "@list" => ".vue-treeselect__list",
            "@item" => ".vue-treeselect__list-item",
            "@multi-label" => ".vue-treeselect__multi-value-label",
            "@control-arrow" => ".vue-treeselect__control-arrow-container",
        ];
    }

    public function selectFirst(Browser $browser, int $depth): void
    {
        $browser->click("@container")
            ->waitFor("@menu");

        $browser->elements("@list")[0]->click();
        for ($i = 0; $i < $depth; $i++) {
            $browser->waitFor("@item")
                ->elements("@item")[0]->click();
        }

        $browser->waitFor("@multi-label")
            ->click("@control-arrow");

        $browser->waitUntilMissing("@menu");
    }
}
