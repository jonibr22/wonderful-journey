<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $session = Auth::user();
        $user = User::where('id',$session->id)->first();
        return view('blog.index',[
            'articles' => $user->articles
        ]);
    }
    public function create(){
        $categories = Category::all();
        return view('blog.add-blog',[
            'categories' => $categories
        ]);
    }
    public function doInsert(Request $request){
        $request->validate([
            'title' => ['required','string','max:255'],
            'category' => ['required'],
            'story' => ['required'],
            'file' => ['required','mimes:jpg,jpeg,png'] 
        ]);
        $user = Auth::user();
        if ($request->file()) {
            $filename = $request->file->getClientOriginalName();
            $request->file('file')->move('uploads', $filename, 'public');
            Article::create([
                'title' => $request->title,
                'category_id' => $request->category,
                'user_id' => $user->id,
                'description' => $request->story,
                'image' => $filename
            ]);
            return redirect()->route('blog')->with('success','The article was successfully published');
        }
        return redirect()->route('blog.create')->with('failed','An error has occured');
    }
    public function destroy($id){
        $session = Auth::user();
        Article::where([
            ['id',$id],
            ['user_id',$session->id]
        ])->delete();
        return redirect()->route('blog')->with('success', 'The article was successfully removed');
    }
}
