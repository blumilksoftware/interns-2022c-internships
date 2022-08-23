<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Internships\Models\Department;
use Internships\Models\StudyField;
use Symfony\Component\Yaml\Yaml;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $yamlContent = Yaml::parseFile(__DIR__ . "/Data/college.yml");
        $departments = collect($yamlContent)->get("departments");

        foreach ($departments as $departmentData) {
            $department = Department::create([
                "name" => $departmentData["name"],
            ]);
            $this->fillStudyFields($department, $departmentData["fields_of_study"]);
        }
    }

    protected function fillSpecializations(StudyField $studyField, array $specializations): void
    {
        foreach ($specializations as $specializationName) {
            $studyField->specializations()->create([
                "name" => $specializationName,
            ]);
        }
    }

    protected function fillStudyFields(Department $department, array $studyFields): void
    {
        foreach ($studyFields as $studyFieldData) {
            $studyField = $department->studyFields()->create([
                "name" => $studyFieldData["name"],
            ]);

            $this->fillSpecializations($studyField, $studyFieldData["specializations"]);
        }
    }
}
