<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUserCard($id){

        
        // $card = User::find($id)->card;
        $user = User::find($id);
        $card = $user->card;
        
        return response()->json([
            "data" => $card
        ],200);
    }

    public function getUserArticles($id){
        
        // $card = User::find($id)->card;
        $user = User::find($id);
        $articles = $user->articles;
        
        return response()->json([
            "data" => $articles
        ],200);
    }
}
