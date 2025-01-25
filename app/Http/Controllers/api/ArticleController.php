<?php

namespace App\Http\Controllers\api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        if($articles)
        {
            return response()->json(
                ['success'=>true , 'user token' => Auth::user()->bearer_token, 'articles'=>$articles]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'articles'=>null]
        );
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $article = Article::create($request->only('title','content'));
        if($article)
        {
            return response()->json(
                ['success'=>true , 'message'=>'added' , 'article'=>$article]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'article'=>null]
        );
    }

    public function show($id)
    {
        $article = Article::where('id' , $id)->first();
        if(!empty($article))
        return response()->json(
            ['success'=>true , 'message'=>'found' ,'article'=>$article]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'article'=>null]
        );
    }


    public function edit(Article $article)
    {
        //
    }


    public function update(Request $request, Article $article)
    {
        //
    }


    public function destroy(Article $article)
    {
        if($article->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=> 'deleted successfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found or deleted']
        );
    }
}
