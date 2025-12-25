<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Software Development',
                'description' => 'Responsible for developing and maintaining software applications, web platforms, and mobile apps.',
                'status' => 'active',
            ],
            [
                'name' => 'Quality Assurance',
                'description' => 'Ensures software quality through testing, bug tracking, and quality control processes.',
                'status' => 'active',
            ],
            [
                'name' => 'DevOps',
                'description' => 'Manages infrastructure, deployment pipelines, and system operations.',
                'status' => 'active',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Creates user interfaces and designs user experiences for digital products.',
                'status' => 'active',
            ],
            [
                'name' => 'Data Science',
                'description' => 'Analyzes data, builds machine learning models, and provides data-driven insights.',
                'status' => 'active',
            ],
            [
                'name' => 'Cybersecurity',
                'description' => 'Protects company systems and data from security threats and vulnerabilities.',
                'status' => 'active',
            ],
            [
                'name' => 'Project Management',
                'description' => 'Plans, executes, and oversees IT projects to ensure timely delivery.',
                'status' => 'active',
            ],
            [
                'name' => 'IT Support',
                'description' => 'Provides technical support and maintains IT infrastructure for the organization.',
                'status' => 'active',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}