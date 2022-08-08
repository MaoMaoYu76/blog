@extends('tem.master')
@section('content')
<div class="container py-5">
    <div class="row jutify-content-center">
        <div class="col-8">
            <h1>垃圾桶</h1>
            <hr>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>標題</th>
                    <th>作者</th>
                    <th>最後更新時間</th>
                    <th>刪除時間</th>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>{{$post->deleted_at}}</td>
                    <td>
                        <form action="{{route('trash.delete',['id'=>$post->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="清除" class="btn btn-outline-danger" onclick="return confirm('確認刪除？')">
                        </form>
                        <a href="{{route('trash.restore',['id'=>$post->id])}}"  class="btn btn-outline-success">還原</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection