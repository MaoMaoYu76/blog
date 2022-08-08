@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row jutify-content-center">
        <!-- 迴圈可以在show裡面做，或者在此頁面進行。 -->
        <div class="col-8">
            <h2>{{$post->title}}</h2>
            <div class="content">
                {!!nl2br($post->content)!!}
            </div>
            <div>作者：{{$post->user->name}}</div>
            <div>
            @php    Carbon\Carbon::setLocale('zh_TW') @endphp
            最後更新時間{{Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}
            </div>
            <hr>
            <a class="btn btn-outline-info"  href="{{route('posts.index')}}">回上一頁</a>
            @if($post->user->id==Auth::id())
            <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-outline-danger" value="刪除" onclick="return confirm('確認刪除？')">
            </form>
            <a href="{{route('posts.edit',['post'=>$post->id])}}"  class="btn btn-outline-success">編輯 </a>
            @endif
        </div>
    </div>
</div>
@endsection