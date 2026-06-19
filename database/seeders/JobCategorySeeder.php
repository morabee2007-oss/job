<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Software Development',
            'Design',
            'Marketing',
            'Sales',
            'Human Resources',
            'Accounting',
            'Customer Support',
        ];

        foreach ($categories as $category) {
            JobCategory::updateOrCreate(
                ['name' => $category],
                ['name' => $category]
            );
        }
    }
}
