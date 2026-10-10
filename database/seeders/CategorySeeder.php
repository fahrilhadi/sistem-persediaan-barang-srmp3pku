<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pusdiklatbangprof',
                'slug' => 'pusdiklatbangprof',
                'group_type' => 'persediaan',
            ],
            [
                'name' => 'Biro Umum',
                'slug' => 'biro-umum',
                'group_type' => 'persediaan',
            ],
            [
                'name' => 'PPK Non Ops',
                'slug' => 'ppk-non-ops',
                'group_type' => 'persediaan',
            ],
            [
                'name' => 'ATK',
                'slug' => 'atk',
                'group_type' => 'atk',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'group_type' => $category['group_type'],
                ]
            );
        }
    }
}