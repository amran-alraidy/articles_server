<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article ;

class ArticleController extends Controller
{
     public function index(){
        $articles = Article::all();

        if(!$articles){
            return response()->json([
                "message" => "article not founded"
            ]);
        }
        return response()->json([
            "data" => $articles
        ],200);
    }

     public function show($id){

        $article = Article::find($id);

        if(!$article){
            return response()->json([
                "message" => "Not found this article"
             ]);
        }

        return response()->json([
            "data" => $article
        ],200);

        
    }


  public function store(Request $request)
    {
         $request->validate([
            'title' => ['required','max:30'],
            'body' => ['string']
        ]);

        $article = new Article ;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = auth()->id();
        $article->save();
 
        return response()->json([
            "message" => "Inserted Successfuly",
            "data" => $article
        ],201);
    }

     public function update(Request $request, $id){

        
         $request->validate([
            'title' => ['required','max:30'],
            'body' => ['string']
        ]);

        $article = Article::find($id);

        if(auth()->id() !== $article->user_id){
             return response()->json([
                "message" => "you can't update this article"
             ]);
        }

        if(!$article){
            return response()->json([
                "message" => "Not found this article"
             ]);
        }

        if($request->has('title')){
            $article->title = $request->title;
        }
        if($request->has('body')){
            $article->body = $request->body;
        }

        $article->save();
 
        return response()->json([
            "message" => "Updated Successfuly",
            "data" => $article
        ],200);
    }

     public function destroy($id){

        $article = Article::find($id);

        if(auth()->id() !== $article->user_id){
             return response()->json([
                "message" => "you can't delete this article"
             ]);
        }

        if(!$article){
            return response()->json([
                "message" => "Not found this article"
             ]);
        }
        $article->delete();

        return response()->json([
                "message" => "article was deleted"
        ],204);
    
    }

    public function getArticleUser($id){

         $article = Article::find($id);
         $user = $article->user;

          return response()->json([
            "data" => $user
        ],200);
    }
}
