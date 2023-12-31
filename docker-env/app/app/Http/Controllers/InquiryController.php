<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InquiryController extends Controller
{
    public function index(){
        $inquiry=Inquiry::where('category',1)->get()->toArray();
        return view('inquiry.index',[
            'inquiry'=>$inquiry,
        ]);
    }

    public function create()
    {
        return view('inquiry.create');
    }

    public function store(Request $request)
    {
        $inquiry=new Inquiry;
        if($request->category==1){
            $columns=['email','category','question'];
            foreach($columns as $column){
                $inquiry->$column=e($request->$column);
            }
            $inquiry->save();
            return redirect(route('inquiry.index'));
        }elseif($request->category==2){
            $columns=['email','category','user_name','user_email'];
            foreach($columns as $column){
                $inquiry->$column=e($request->$column);
            }
            $inquiry->user_pass=e(Hash::make($request->user_pass));
            $inquiry->save();
            return redirect(route('inquiry.index'));
        }elseif($request->category==3){
            $columns=['email','category','user_name','user_email','recipe_display','recipe_title'];
            foreach($columns as $column){
                $inquiry->$column=e($request->$column);
            }
            $inquiry->user_pass=e(Hash::make($request->user_pass));
            $inquiry->save();
            return redirect(route('inquiry.index'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Inquiry $inquiry)
    {
        $inquiry=Inquiry::where('id',$inquiry['id'])->get()->toArray();
        return view('inquiry.edit',[
            'inquiry'=>$inquiry,
        ]);
    }

    public function update(Request $request,Inquiry $inquiry)
    {
        $inquiry->answer=$request->answer;
        $inquiry->save();
        return redirect(route('inquiry.index'));
    }

    public function destroy($id)
    {
        //
    }
}
