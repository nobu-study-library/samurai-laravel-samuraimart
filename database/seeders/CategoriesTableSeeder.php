<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $majorCategoryList = ['本', 'コンピュータ', 'ディスプレイ'];

    $bookCategoryList = [
      'ビジネス',
      '文学・評論',
      '人文・思想',
      'スポーツ',
      'コンピュータ・IT',
      '資格・検定・就職',
      '絵本・児童書',
      '写真集',
      'ゲーム攻略本',
      '雑誌',
      'アート・デザイン',
      'ノンフィクション',
    ];
    $computerCategoryList = ['ノートPC', 'デスクトップPC', 'タブレット'];
    $displayCategoryList = ['19〜20インチ', 'デスクトップPC', 'タブレット'];

    foreach ($majorCategoryList as $majorCategory) {
      if ($majorCategory === '本') {
        foreach ($bookCategoryList as $bookCategory) {
          Category::create([
            'name' => $bookCategory,
            'description' => $bookCategory,
            'major_category_name' => $majorCategory,
          ]);
        }
      }

      if ($majorCategory === 'コンピュータ') {
        foreach ($computerCategoryList as $computerCategory) {
          Category::create([
            'name' => $computerCategory,
            'description' => $computerCategory,
            'major_category_name' => $majorCategory,
          ]);
        }
      }

      if ($majorCategory === 'ディスプレイ') {
        foreach ($displayCategoryList as $displayCategory) {
          Category::create([
            'name' => $displayCategory,
            'description' => $displayCategory,
            'major_category_name' => $majorCategory,
          ]);
        }
      }
    }
  }
}
