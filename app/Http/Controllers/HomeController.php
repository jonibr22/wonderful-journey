<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $articles = Article::all();
        return view('home.index',[
            'articles' => $articles
        ]);
    }
    public function detail($id){
        $article = Article::where('id',$id)->first();
        if($article != null){
            return view('home.detail',[
                'article' => $article
            ]);   
        }     
        return redirect('/');
    }
    public function category($id){
        $category = Category::where('id',$id)->first();
        if($category != null){
            return view('home.category',[
                'category' => $category
            ]);   
        }     
        return redirect('/');       
    }
}
