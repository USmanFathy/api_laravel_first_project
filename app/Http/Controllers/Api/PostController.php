<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResposeTrait;
    public function index(){
        $posts = PostResource::collection(Post::all());
        $msg = 'test';
        $apirespone =$this->Apidata($posts ,200 , $msg);
        return $apirespone;
    }

    public function show($id){
        $post = Post::find($id);
        if ($post){
            $msg = 'done';
            $status = 200;
            $post = new PostResource($post);

        }else{
            $msg = 'notfound';
            $status=404;

        }
        $apirespone = $this->Apidata($post,$status , $msg);
        return $apirespone;
    }
    public function store(Request $request){
        $request->validate(
            ['title'=>'required'],
            ['title.required'=>'this field is required']
        );
        if ($validator->fails()){
            $apirespone = $this->Apidata(null,404 , 'this field is required');

        }
       $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

       if ($post){
           $msg = 'created';
           $status = 201;
           $post = new PostResource($post);
       }else{

           $msg = 'notfound';
           $status=404;
       }
        $apirespone = $this->Apidata($post,$status , $msg);
        return $apirespone;
    }


    public function destroy(){
        $post = Post::findOrFail($id);
        if($post){
            $post->delete();
            $msg = 'deleted';
            $status = 200;
        }else{

            $msg = 'notfound';
            $status=404;
        }
        $post = null;
        $apirespone = $this->Apidata($post,$status , $msg);
        return $apirespone;

    }
    public function update(  $id ,Request $request){
        $post = Post::find($id);
        if($post){
            $post->update([
                'title'=>$request->title,
                'body'=>$request->body
            ]);
            $msg = 'updated';
            $post = new PostResource($post);
            $status = 204;
        }else{

            $msg = 'notfound';
            $status=404;
        }
        $apirespone = $this->Apidata($post,$status , $msg);
        return $apirespone;

    }

}
