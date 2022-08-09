@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-8">
            <h1>編輯文章</h1>
            <hr>
            <form action="{{route('posts.update',['post'=>$post->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Article Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                </div>
            
                <div class="form-group">
                    <label for="tag">標籤（請以#為字串開頭喔！）</label>
                    <input type="text" name="tag" id="tag" class="form-control" value="{{$post->toTagString()}}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $cate)
                        <option value="{{$cate->id}}" {{$post->category_id == $cate->id ? "selected" : ""}}>{{$cate->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" cols="30" rows="10">{!!($post->content)!!}</textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="更新文章">
                <input type="button" class="btn btn-danger" value="取消" onclick="history.back()">
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection