<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MajorCategory;

class MajorCategoriesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $majorCategoryNames = ['本', 'コンピューター', 'ディスプレイ'];

    foreach ($majorCategoryNames as $majorCategoryName) {
      MajorCategory::create([
        'name' => $majorCategoryName,
        'description' => $majorCategoryName,
      ]);
    }
  }
}
