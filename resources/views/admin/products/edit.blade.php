@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить товар
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open(['route'=>['product.update',$product->id],
                        'method'=>'put',
                        'files'=>true])}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактирование товара</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Наименование</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="description" placeholder="" value="{{$product->description}}">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Стоимость</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="price" placeholder="" value="{{$product->price}}">
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{form::select('category_id',
                                $categories,
                                $product->getCategoryID(),
                                ['class' => 'form-control select2'])
                               }}
                        </div>
                        <div class="form-group">
                            <img src="{{$product->getImage()}}" width="200" alt="" class="img-responsive">
                            <label for="exampleInputFile">Изображение товара</label>
                            <input type="file" name="picture" id="exampleInputFile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Статус</label>
                            <label>

                                {{Form::checkbox('status', '1', $product->status, ['class'=>'minimal'] )}}
                            </label>
                            <label>
                                Активно
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {{Form::checkbox('is_featured', '1', $product->is_featured, ['class'=>'minimal'] )}}

                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
                {{Form::close()}}
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection