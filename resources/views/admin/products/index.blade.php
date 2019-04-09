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
                    <div class="form-group">
                        <a href="{{route('product.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Наименование</th>
                            <th>Описание</th>
                            <th>Стоимость</th>
                            <th>Категория</th>
                            <th>Фото</th>
                            <th>Статус</th>
                            <th>Действия</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product )
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->getCategoryTitle()}}</td>
                                <td>
                                    <img src="{{$product->getImage()}}" alt="" name="picture" class="img-responsive" width="150">
                                </td>
                                <td>{{$product->inStock()}}</td>
                                <td><a href="{{route('product.edit',$product->id)}}" class="fa fa-pencil"></a>

                                    {{Form::open(['route'=>['product.destroy',$product->
                                   id],'method'=>'delete'])}}
                                    <button onclick="return confirm('Желаете удалить?')" type="submit" class="delete">
                                        <i class="fa fa-remove"></i></td>
                                </button>


                                {{Form::close()}}</td>


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