
@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить заказ
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'=>'orders.store',
            'files'=> true

        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем заказ
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Адрес</label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value="{{old('address')}}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Статус</label>
                            <input type="text" class="form-control" name="status" id="exampleInputEmail1" value="{{old('status')}}" placeholder="">
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
                            <label>Товары</label>
                            {{form::select('products[]',
                                $products,
                                null,
                                ['class' => 'form-control select2','multiple'=>'multiple','data-placeholder'=>'Выберите товары'])
                               }}

                        </div>
                        <div class="form-group">
                            <label>Способ оплаты:</label>
                            {{form::select('payments_id',
                                $payments,
                                null,
                                ['class' => 'form-control select2'])
                               }}
                        </div>
                        <!-- Date -->

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close( )}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection