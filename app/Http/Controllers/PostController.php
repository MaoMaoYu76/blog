<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::orderby('id','DESC')->get();
        //->all靜態方法不能用在此，會用在request取得所有陣列值
        // orderby排序遞增原始狀態為'DB::select('SELECT * FROM newses orderby id ASC')
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories= Category::get();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 最原始的寫法啟用use中的DB，從裡面呼叫細項。
        // DB::insert('INSERT INTO newses(title,content,created_at,updated_at)VALUES(?,?,?,?)',[
        //     $request->title,
        //     $request->content,
        //     now(),
        //     now()
        // ]);


        $post=new Post;

        if($request->file('cover')){
            // 如果cover是空值就不需要上傳，故給判斷式。
            $ext=$request->file('cover')->getClientOriginalExtension();
            $cover = Str::uuid().'.'.$ext;
            $request->file('cover')->storeAs('public/images',$cover);
        }else{
            $cover='';
        }
        
        $request->validate([
            'title'    =>'required',
            'content'  =>'required'
            // 若要套用兩種驗證，可用|分隔。
        ]);

        $post->fill($request->all());
        $post->user_id=Auth::id();
        $post->category_id=$request->category_id;
        $post->cover=$cover;
        //關聯式只能接受動態方法，舉凡有檔案、圖片、關聯資料表都需要用到。
        //靜態方法Post::create只能使用在純文字、單一資料表。
        $post->save();

        $tags=explode('#',$request->tag);
        foreach($tags as $tag){
            $tagModel = Tag::firstOrCreate(['title'=>$tag]);
            $post->tags()->attach($tagModel->id);
        }
        return redirect()->route('posts.index');
        //return $request->file('cover')->storeAs('public/images','名稱');
        // 要有public使用者才能看到圖片，若沒有使用會影響到php artisan storage:link的指令。
        // storeAs的檔名為自訂
        // 取得原始檔案名稱->getClientOriginalName();
        // 取得原始檔案副檔名->getClientOriginalExtension();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories=Category::get();
        return view ('posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $post->fill($request->all());
        $post->category_id=$request->category_id;
        $post->save();

        $post->tags()->detach();
        // 先切斷關聯，再建立關聯才不會有重複的關聯。
        $tags=explode('#',$request->tag);
        foreach($tags as $tag){
            $tagModel = Tag::firstOrCreate(['title'=>$tag]);
            $post->tags()->attach($tagModel->id);
        }

        return redirect()->route('posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function postsTag(Tag $tag){
        $posts = $tag->posts;

        return view('posts.tag',compact('posts'));
    }
    public function postsCategory(Category $category){
        $posts = $category->posts;

        return view('posts.category',compact('posts'));
    }

    public function trash(){
        $posts= Post::onlyTrashed()->get();
        return view('posts.trash',compact('posts'));
    }
    public function trashDelete($id){
        Post::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('trash.index');
    }

    public function trashRestore($id){
        Post::onlyTrashed()->find($id)->restore();
        return redirect()->route('trash.index');
    }
}
