<?php

declare(strict_types=1);

namespace Internships\Interfaces;

interface BuildTool
{
    public function defineDataFields();

    public function buildFromData(array $csvData, bool $serializeSubData = false): array;

    public function validate(int $id, array $entry): array;

    public function getModelClassToBuild(): string;

    public function setPaths(): void;

    public function processEntry(int $entryId, array $entry): array;

    public function onBuildStart();

    public function onBuildEnd();
}
