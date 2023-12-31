<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function create()
    {
        $session=session()->get('ingredient');
        return view('ingredient.create',[
            'session'=>$session,
        ]);
    }

    public function store(Request $request)
    {
        session()->put('ingredient',$request->all());
        return redirect(route('step.create'));
    }

    public function edit(Recipe $recipe)
    {
        if($recipe['user_id']==Auth::user()->id){
            $ingredients=$recipe->ingredients->toArray();
            return view('ingredient.edit',[
                'ingredients'=>$ingredients,
                'recipeId'=>$recipe['id'],
            ]);
        }else{
            return redirect(route('recipe.index'));
        }
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