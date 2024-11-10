<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;


class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $electronics=['Mobile','Laptop','Computer','Washing Machine'];
            $clothing=['Men','Women','Children'];

            $elc_id = Category::where('name', 'electronics')->first();
            foreach ($electronics as $subcategoryName) {
                $subCategory = new SubCategory;
                $subCategory->category_id = $elc_id->id; // Fixed this line
                $subCategory->name = $subcategoryName;
                $subCategory->save();
            }

            // Fetch the category ID for clothing
            $col_id = Category::where('name', 'clothing')->first();
            foreach ($clothing as $subcategoryName) {
                $subCategory = new SubCategory;
                $subCategory->category_id = $col_id->id; // Fixed this line
                $subCategory->name = $subcategoryName;
                $subCategory->save();
            }
    }
}
