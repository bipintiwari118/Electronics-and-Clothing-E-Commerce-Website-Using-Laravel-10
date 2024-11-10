<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=['Electronics','Clothing'];

        foreach($categories as $category){
            $cat=new Category;
            $cat->name=$category;
            $cat->save();
        }
    }
}
