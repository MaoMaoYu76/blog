<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Postscontroller extends Controller
{
    function index(){
        $posts=DB::select('SELECT * FROM posts');
        return view('posts.index',compact('posts'));
    }
    function create(){
        return view('posts.create');
    }
    function store(Request $request){
        DB::insert('INSERT INTO posts(title,content,created_at,updated_at)VALUES(?,?,?,?)',[
            $request->title,
            $request->content,
            now(),
            now()
        ]);
        return redirect()->route('blog.index');
    }
    function show($id){
        $posts=DB::select('SELECT * FROM posts WHERE id=?',[$id]);
        return view('posts.show',compact('posts'));
    }

    function delete(Request $request){
        DB::delete('DELETE FROM posts WHERE id=?',[$request->id]);
        return redirect()->route('blog.index');
    }

    function edit($id){
        $posts=DB::select('SELECT * FROM posts WHERE id=?',[$id]);
        return view('posts.edit',compact('posts'));
    }
    function update(Request $request){
        DB::update('UPDATE posts SET title=?,content=?,updated_at=? WHERE id=?',[
            $request->title,
            $request->content,
            now(), 
            $request->id
        ]);
        return redirect()->route('blog.index');
    }

}
