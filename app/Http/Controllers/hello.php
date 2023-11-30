<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Carbon\Carbon;

class hello extends Controller
{
    //form submit function
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
        return response()->json(['msg'=>'record inserted'], 201);
        
    }

    //form display function
    public function form_display()
    {
        $show=Post::get()->toJson(JSON_PRETTY_PRINT);
        return response($show);

    }

    //delete function
    public function delete($id)
    {
        if(Post::where('id',$id)->exists())
        {
            $delete=Post::find($id);
            $delete->delete();
            return response()->json(['msg'=>'record deleted'], 200);
        }
       else
       {
            return response()->json(['msg'=>'record not found'], 404);
       }
    }

    //to fetch record to edit  
    public function edit($id)
    {
        if(Post::where('id',$id)->exists())
        {
            $fetch=Post::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($fetch);
        }
       else
       {
            return response()->json(['msg'=>'record not found'], 404);
       }
    }

    //update function 
    public function update(Request $request, $id)
    {
        if(Post::where('id',$id)->exists())
        {
            $data=Post::find($id);
            $data->name=$request->get('name');
            $data->email=$request->get('email');
            $data->course=$request->get('course');
            $data->save();
            return response()->json(['msg'=>'UPDATED '], 200);
        }
        else
        {
             return response()->json(['msg'=>'record not found'], 404);
        }
    } 

    //search function
    public function search($name)
    {
        if(Post::where('name','LIKE','%'.$name.'%')->exists())
        {
            $data=Post::where('name','LIKE','%'.$name.'%')->get()->toJson(JSON_PRETTY_PRINT);
            return response($data);
        }
        else
        {
             return response()->json(['msg'=>'record not found'] ,404);
        }
    }
    
    //current date and time
    public function datetime()
    {
        $datetime=Carbon::now('Asia/Kolkata');
        echo $datetime;
    }

    //image upload
    public function imageUpload(Request $request)
    {
        $uploadFolder = 'users';
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $image_uploaded_path = $image->move($uploadFolder, $filename, 'public');
            
            if($request->isMethod('post')){
                $img = new Image;
                $img->image = $image_uploaded_path;
                $img->save(); // You should save the image record to the database.
            }
    
            return response()->json(["message" => "Image Uploaded"], 200);

        } else {
            return response()->json(["message" => "No file uploaded"], 404); // Return a proper error response.
        }
    }
    
}
