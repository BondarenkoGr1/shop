
@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Изменить заказ
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    {{Form::open([
        'route' =>['orders.update',$order->id],
        'files' => 'true',
        'method' => 'put'
        ])}}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Обновляем заказ</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
             <div class="form-group">
                 <label for="exampleInputEmail1">Адрес</label>
                 <input type="text" class="form-control" name="address" id="exampleInputEmail1" value="{{$order->address}}" placeholder="">
            </div>
            <div class="form-group">
              <label>Товары</label>
              {{form::select('products[]',
                  $products,
                  $order->products->pluck('id')->all(),
                  ['class' => 'form-control select2','multiple'=>'multiple','data-placeholder'=>'Выберите товары'])
                 }}

            </div>
             <div class="form-group">
                 <label>Способ оплаты:</label>
                    {{form::select('payments_id',
                       $payments,
                        $order->payments->id,
                       ['class' => 'form-control select2'])
                         }}
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Статус</label>
              <label>

                {{Form::checkbox('status','1', $order->status, ['class'=>'minimal'] )}}
              </label>
              <label>
                Выполнен
              </label>
            </div>
          </div>
          <div class="col-md-12">

        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-default">Назад</button>
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    {{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection