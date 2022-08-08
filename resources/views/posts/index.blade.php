@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row jutify-content-center">
        <div class="col-8">
            <h1>文章列表</h1>
            <hr>
        </div>
        @foreach ($posts as $post)
        <div class="col-8">
            <h3><a href="{{route('posts.category',['category'=>$post->category_id])}}" class="badge bg-success">{{$post->category->title}}</a>{{$post->title}}</h3>
            <div>@foreach($post->tags as $tag)
                <a href="{{route('posts.tag',['tag'=>$tag->id])}}" class="badge bg-info text-white">{{$tag->title}}</a>
                @endforeach
            </div>
            <div>
                <img src="{{asset('storage/images/'.$post->cover)}}" class="w-50">
            </div>
            <div class="content">
                {!!nl2br(Str::limit($post->content,200))!!}
            </div>
            <div>作者：{{$post->user->name}}</div>
            <a href="{{route('posts.show',['post'=>$post->id])}}" class="btn btn-primary">繼續閱讀</a>
            <div>
                @php Carbon\Carbon::setLocale('zh_TW') @endphp
                <!-- 可查詢php carbon來了解詳細，多與時間戳記有關。 -->
                最後更新時間{{Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}
            </div>
            <hr>
        </div>
        @endforeach
    </div>
</div>
@endsection