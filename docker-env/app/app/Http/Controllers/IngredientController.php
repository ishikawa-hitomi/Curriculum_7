<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function create()
    {
        return view('ingredient.create');
    }

    public function store(Request $request)
    {
        session()->put('ingredient',$request->all());
        return redirect(route('step.create'));
    }

    public function edit(Recipe $recipe)
    {
        $ingredients=$recipe->ingredients->toArray();
        return view('ingredient.edit',[
            'ingredients'=>$ingredients,
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function update(Request $request,Recipe $recipe)
    {
        Ingredient::where('recipe_id','=',$recipe['id'])->delete();
        Ingredient::onlyTrashed()->whereNotNull('id')->where('recipe_id','=',$recipe['id'])->forceDelete();
        $name=$request['name'];
        $quantity=$request['quantity'];
        $count=count($name);
        for($a=0; $a<$count; $a++){
            $ingredient=new Ingredient;
            $ingredient->name=e($name[$a]);
            $ingredient->quantity=e($quantity[$a]);
            $ingredient->recipe_id=$recipe['id'];
            $ingredient->save();
        }
        return redirect(route('step.edit',['recipe'=>$ingredient['recipe_id']]));
    }
}