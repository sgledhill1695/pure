<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class DogController extends Controller
{

    public $breeds = [
        'cockapoo',
        'dalmatian',
        'whippet',
        'pug',
        'labrador',
        'frenchie'
    ];

    public $allergens = [
        'beef',
        'duck',
        'chicken',
        'fish', 
        'turkey'
    ];

    public $validation_rules = [
        'name' => 'required|max:255',
        'years' => 'required|integer|gte:0',
        'months' => 'required|integer|between:1,12',
        'breed' => 'required|string',
        'allergies' => 'required|array'
    ];

    public $final_validation_rules = [
        'name' => 'required|max:255',
        'years' => 'required|integer|gte:0',
        'months' => 'required|integer|between:1,12',
        'breed' => 'required|string',
        'allergies' => 'required|array',
        'subscription_id' => 'required|integer|gt:0'
    ];


    public function yearsToMonths($years, $months)
    {
        return $years * 12 + $months;
    }

    function convertMonthsToReadable($months)
    {
        $years = floor($months / 12);
        $remaining_months = $months % 12;

        $age_string = '';

        if ($years > 0) {
            $age_string .= $years . ' year';
            if ($years > 1) {
                $age_string .= 's';
            }
        }

        if ($remaining_months > 0) {
            if ($years > 0) {
                $age_string .= ' and ';
            }
            $age_string .= $remaining_months . ' month';
            if ($remaining_months > 1) {
                $age_string .= 's';
            }
        }

        return $age_string;
    }
    
    public function getSuitableRecipes($dog){

        $recipes = DB::table('recipes')->get();

        //If puppy exclude inappropriate recipes
        if ($dog['age'] < 7) {
            $recipes = $recipes->filter(function ($recipe) {
                return $recipe->puppy_inappropriate == false;
            });
        }

        //Filter out recipes that match dogs allergies
        if (count($dog['allergies']) > 0) {
            $recipes = $recipes->filter(function ($recipe) use ($dog) {
                return !in_array($recipe->allergen, $dog['allergies']);
            });
        }

        //return only recipes appropriate for this breed
        $recipes = $recipes->filter(function ($recipe) use ($dog) {
            return $recipe->breed_inappropriate != $dog['breed'];
        });

        return $recipes;
    }




    public function index()
    {
        $dogs = Dog::orderBy('created_at', 'desc')->get();

        foreach ($dogs as $dog) {
            $dog->formatted_age = $this->convertMonthsToReadable($dog->age);
            $dog->suitable_recipes = $this->getSuitableRecipes($dog);
            $dog->subscription && $dog->subscription->recipe;
        }

        return view('dogs/index', ['dogs' => $dogs]);
    }




    public function create()
    {
        return view('dogs/create', [
            'breeds' => $this->breeds,
            'allergens' => $this->allergens
        ]);
    }



    public function recipes(Request $request)
    {
        $request->validate($this->validation_rules);

        $dog = [
            'name' => ucfirst($request->name),
            'breed' => $request->breed,
            'years' => $request->years,
            'months' => $request->months,
            'age' => $this->yearsToMonths($request->years, $request->months),
            'allergies' => $request->allergies,
        ];

        $recipes = $this->getSuitableRecipes($dog);

        return view('dogs.recipes', [
            'dog' => $dog,
            'recipes' => $recipes
        ]);
    }




    public function store(Request $request)
    {
        $request->validate($this->final_validation_rules);

        $provided_allergies = $request->allergies;

        if(in_array('none', $provided_allergies)){
            $provided_allergies = [];
        }

        $dog = Dog::create([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $this->yearsToMonths($request->years, $request->months),
            'allergies' => $provided_allergies,
        ]);

        Subscription::create([
            'dog_id' => $dog->id,
            'recipe_id' => $request->subscription_id
        ]);

        return redirect('/');
    }
}
