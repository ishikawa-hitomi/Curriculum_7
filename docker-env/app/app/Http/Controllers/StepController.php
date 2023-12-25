<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StepController extends Controller
{
    public function create()
    {
        return view('step.create');
    }

    public function store(Request $request)
    {
        $out_recipe=session()->pull('recipe');
        $out_recipe->save();

        $out_inredient=session()->pull('ingredient');
        $name=$out_inredient['name'];
        $quantity=$out_inredient['quantity'];
        $count=count($name);
        for($a=0; $a<$count; $a++){
            $ingredient=new Ingredient;
            $ingredient->name=e($name[$a]);
            $ingredient->quantity=e($quantity[$a]);
            $ingredient->recipe_id=$out_recipe['id'];
            $ingredient->save();
        }

        $procedure=$request['procedure'];
        $sub_image=$request['sub_image'];
        $count=count($procedure);
        for($a=0; $a<$count; $a++){
            $step=new Step;
            $step->procedure=e($procedure[$a]);
            $step->recipe_id=$out_recipe['id'];
            $image_path=$sub_image[$a]->store('public');
            $step->sub_image=basename($image_path);
            $step->save();
        }
        return redirect(route('recipe.show',['recipe'=>$out_recipe['id']]));
    }

    public function edit(Recipe $recipe)
    {
        if($recipe['user_id']==Auth::user()->id){
            $steps=$recipe->steps->toArray();
            return view('step.edit',[
                'steps'=>$steps,
                'recipeId'=>$recipe['id'],
            ]);
        }else{
            return redirect(route('recipe.index'));
        }
    }

    public function update(Request $request,Recipe $recipe)
    {
        Step::where('recipe_id','=',$recipe['id'])->delete();
        Step::onlyTrashed()->whereNotNull('id')->where('recipe_id','=',$recipe['id'])->forceDelete();
        $procedure=$request['procedure'];
        $sub_image=$request['sub_image'];
        $count=count($procedure);
        for($a=0; $a<$count; $a++){
            $step=new Step;
            $step->procedure=e($procedure[$a]);
            $step->recipe_id=$recipe['id'];
            $image_path=$sub_image[$a]->store('public');
            $step->sub_image=basename($image_path);
            $step->save();
        }
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }
}