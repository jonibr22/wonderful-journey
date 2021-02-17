<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','user')->get();
        return view('user.index',[
            'users' => $users
        ]);
    }
    public function destroy($id){
        User::where([
            ['id',$id],
            ['role','user']
        ])->delete();
        return redirect()->route('user')->with('success','The user has been successfully deleted');
    }
    public function listBlog($userId){
        $user = User::where('id',$userId)->first();
        return view('user.blog',[
            'user' => $user
        ]);
    }
    public function destroyBlog($userId,$blogId){
        Article::where([
            ['id',$blogId]
        ])->delete();
        return redirect()->route('user.blog',$userId)->with('success', 'The article was successfully removed');
    }
}
