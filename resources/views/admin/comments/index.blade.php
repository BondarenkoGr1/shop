@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID пользователя</th>
                            <th>Имя пользователя</th>
                            <th>Товар</th>
                            <th>Текст</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->user_id}}</td>
                            <td>{{$comment->author->name}}</td>
                            <td>{{$comment->product->name}}</td>
                            <td>{{$comment->text}}</td>
                            <td>
                            @if($comment->status == 1)
                                    <a href="/admin/comments/toggle/{{$comment->id}}" class="fa fa-lock"></a>
                            @else
                                <a href="/admin/comments/toggle/{{$comment->id}}" class="fa fa-thumbs-o-up"></a>


                            @endif
                                {{Form::open(['route'=>['comments.destroy',$comment->
                                    id],'method'=>'delete'])}}
                                <button onclick="return confirm('Желаете удалить?')" type="submit" class="delete">
                                    <i class="fa fa-remove"></i></td>
                            </button>


                            {{Form::close()}}

                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection