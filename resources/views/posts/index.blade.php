@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row jutify-content-center">
        <div class="col-8">
            <h1>文章列表</h1>
        </div>
        @foreach ($posts as $post)
        <hr>
        <div class="col-10 py-2">
            <h3><a href="{{route('posts.category',['category'=>$post->category_id])}}" class="badge bg-success">{{$post->category->title}}</a>{{$post->title}}</h3>
            <div>
                @foreach($post->tags as $tag)
                <a href="{{route('posts.tag',['tag'=>$tag->id])}}" class="badge rounded-pill bg-primary ">{{$tag->title}}</a>
                @endforeach
            </div>
        </div>
        <div class="col-5 py-2">
            <div class="content">
                {!!Str::limit(strip_tags($post->content),200,'...')!!}
            </div>
            <a href="{{route('posts.show',['post'=>$post->id])}}" class="btn btn-outline-info">繼續閱讀</a>
        </div>
        <div class="col-3 py-2">
            @if($post->cover !='')
            <img src="{{asset('storage/images/'.$post->cover)}}" class="img-fluid">
            @endif
        </div>
        <div>作者：{{$post->user->name}}</div>

        <div>
            @php Carbon\Carbon::setLocale('zh_TW') @endphp
            <!-- 可查詢php carbon來了解詳細，多與時間戳記有關。 -->
            最後更新時間{{Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}
        </div>
        @endforeach
    </div>
</div>

@endsection