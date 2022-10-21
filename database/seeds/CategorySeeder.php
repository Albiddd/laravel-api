<?php


use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Cinema', 'Serie TV', 'Food', 'Moda', 'Videogame', 'Sport'];

        foreach ($categories as $category_name) {

            $c = new Category();
            $c->name = $category_name;
            $c->slug = Str::slug($category_name);

            $c->save();
        }
    }
}
