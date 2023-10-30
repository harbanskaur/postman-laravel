<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class hello extends Controller
{
    public function form_submit(Request $request)
    {
        $data=new Post;
        if($request->isMethod('post'))
        {
            $data->name=$request->get('name');
            $data->email=$request->get('email');
            $data->course=$request->get('course');
            $data->save();

        }
        return response()->json(['msg'=>'record inserted']);
        
    }
    public function form_display()
    {
        $show=Post::get()->toJson(JSON_PRETTY_PRINT);
        return response($show);

    }
    public function delete($id)
    {
        if(Post::where('id',$id)->exists())
        {
            $delete=Post::find($id);
            $delete->delete();
            return response()->json(['msg'=>'record deleted']);
        }
       else
       {
            return response()->json(['msg'=>'record not found']);
       }
    }
    public function edit($id)
    {
        if(Post::where('id',$id)->exists())
        {
            $fetch=Post::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($fetch);
        }
       else
       {
            return response()->json(['msg'=>'record not found']);
       }
    }
    public function update(Request $request, $id)
    {
        if(Post::where('id',$id)->exists())
        {
            $data=Post::find($id);
            $data->name=$request->get('name');
            $data->email=$request->get('email');
            $data->course=$request->get('course');
            $data->save();
            return response()->json(['msg'=>'UPDATED ']);
        }
        else
        {
             return response()->json(['msg'=>'record not found']);
        }
    }

    public function search($name)
    {
        if(Post::where('name','LIKE','%'.$name.'%')->exists())
        {
            $data=Post::where('name','LIKE','%'.$name.'%')->get()->toJson(JSON_PRETTY_PRINT);
            return response($data);
        }
        else
        {
             return response()->json(['msg'=>'record not found']);
        }
    }
}
