@extends('tem.master')
@section('content')
<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container py-5">
        <div class="mb-3">
            <label for="title" class="form-label">Article Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="cover">封面圖片</label>
            <input type="file" name="cover" id="cover">
        </div>
        <div class="form-group">
            <label for="tag">標籤（請以#為字串開頭喔！）</label>
            <input type="text" name="tag" id="tag" class="form-control" value="{{old('tag')}}">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $cate)
                <option value="{{$cate->id}}">{{$cate->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" cols="30" rows="10">{{old('content')}}</textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="新增文章">
        <input type="button" class="btn btn-danger" value="取消" onclick="history.back()">
    </div>
</form>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @if($errors->any())
            @foreach($errors->all() as $error)
        </div>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>{{$error}}</div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
<script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
    // 安裝CKEditor並且置換CKEDITOR.replace('此填入帶入區域名稱')
</script>
@endsection