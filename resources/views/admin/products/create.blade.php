@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить категорию
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                {!! Form::open(['route'=>'product.store','files' => true]) !!}

                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем товар</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Наименование</label>
                            <input type="text" class="form-control" value="{{old('name')}}" id="exampleInputEmail1" placeholder="" name="name">
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Стоимость</label>
                            <input type="text" class="form-control" value="{{old('price')}}" id="exampleInputEmail1" placeholder="" name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Изображение</label>
                            <input type="file"  id="exampleInputEmail1" placeholder="" name="picture">
                            <p class="help-block">Только файлы формата - ".jpg",".jpeg",".png"
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{form::select('category_id',
                                $categories,
                                null,
                                ['class' => 'form-control select2'])
                               }}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Статус</label>
                            <label>
                                <input type="checkbox" class="minimal" name="status">
                            </label>
                            <label>
                                Активно
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name="is_features">
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection