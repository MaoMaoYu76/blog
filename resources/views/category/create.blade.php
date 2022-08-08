@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h2>新增分類</h2>
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <input type="submit" class="btn btn-primary" value="新增分類">
                <input type="button" class="btn btn-danger" value="取消" onclick="history.back()">
            </form>
        </div>
        <div class="col-4">
            <h2>分類列表</h2>
            <ul class="list-group mt-4">
                @foreach($categories as $cate)
                <li class="list-group-item d-flex justify-content-between align-items-center">{{$cate->title}}
                    <form action="{{route('category.destroy',['category'=>$cate->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="刪除" onclick="return confirm('確認刪除？')" class="btn btn-danger">
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection