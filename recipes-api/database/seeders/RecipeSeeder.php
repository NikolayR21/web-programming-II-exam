<?php

namespace Database\Seeders;

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\DishTypeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OccasionController;
use App\Models\Cuisine;
use App\Models\Diet;
use App\Models\DishType;
use App\Models\Ingredient;
use App\Models\Occasion;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $ingredientCtrl = new IngredientController();
        // $occasionCtrl = new OccasionController();
        // $dietCtrl = new DietController();
        // $dishTypeCtrl = new DishTypeController();
        // $cuisineCtrl = new CuisineController();

        {
            $data = Http::acceptJson()->get('https://api.spoonacular.com/recipes/random', [
                'number' => 20,
                'apiKey' => '6c9c38417618439490846ef1dbe0ec64'
            ]);
            
            $data = $data['recipes'];

            foreach($data as $recipe){
                $recipe_id = DB::table('recipes')->insertGetId([
                    'title' => $recipe['title'],
                    'likes' => $recipe['aggregateLikes'],
                    'readyTime' => $recipe['readyInMinutes'],
                    'servings' => $recipe['servings'],
                    'image' => $recipe['image'],
                    'sourceUrl' => $recipe['sourceUrl'],
                    'summary' => $recipe['summary'],
                    'steps' => ''
                ]);
                
                $recipe_steps = [];
                foreach($recipe['analyzedInstructions'][0]['steps'] as $instruction){
                    unset($instruction['ingredients']);
                    unset($instruction['equipment']);
                    unset($instruction['length']);

                    array_push($recipe_steps, $instruction);
                }


                $new_recipe = Recipe::find($recipe_id);

                Recipe::where('id', $recipe_id)->update(['steps' => $recipe_steps]);

                foreach($recipe['extendedIngredients'] as $ingredient){
                    $ingredient_id = Ingredient::firstOrCreate(
                        ['name' => $ingredient['name']],
                        ['name' => $ingredient['name']]
                    );

                    $ingredient_amount = $ingredient['amount'];
                    $ingredient_unit = $ingredient['unit'];

                    $new_recipe->ingredients()->attach($ingredient_id, ['amount' => $ingredient_amount.' '.$ingredient_unit]);
                    
                    // $ingredient_id = DB::table('ingredients')->insertGetId([
                    //     'name' => $ingredient['name']
                    // ]);
                }

                foreach($recipe['occasions'] as $occasion){
                    $occasion_id = Occasion::firstOrCreate(
                        ['name' => $occasion],
                        ['name' => $occasion]
                    );

                    $new_recipe->occasions()->attach($occasion_id);

                    // $occasion_id = DB::table('occasions')->insert([
                    //     'name' => $occasion
                    // ]);
                }

                foreach($recipe['diets'] as $diet){
                    $diet_id = Diet::firstOrCreate(
                        ['name' => $diet],
                        ['name' => $diet]
                    );

                    $new_recipe->diets()->attach($diet_id);

                    // $diet_id = DB::table('diets')->insert([
                    //     'name' => $diet
                    // ]);
                }

                foreach($recipe['dishTypes'] as $dishType){
                    $dish_type_id = DishType::firstOrCreate(
                        ['name' => $dishType],
                        ['name' => $dishType]
                    );

                    $new_recipe->dish_types()->attach($dish_type_id);

                    // $dish_type_id = DB::table('dish_types')->insert([
                    //     'name' => $dishType
                    // ]);
                }

                foreach($recipe['cuisines'] as $cuisine){
                    $cuisine_id = Cuisine::firstOrCreate(
                        ['name' => $cuisine], 
                        ['name' => $cuisine]
                    );

                    $new_recipe->cuisines()->attach($cuisine_id);

                    // $cuisine_id = DB::table('cuisines')->insert([
                    //     'name' => $cuisine
                    // ]);
                }
            }
        }
    }
}
