
@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            {{Form::open([
                'route'=>'orders.store',
                'files'=> true
            ])}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header">

                    @include('admin.errors')
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Адрес</th>
                            <th>Способ оплаты</th>
                            <th>Товары</th>
                            <th>Сумма заказа</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->getPaymentTitle()}}</td>
                            <td>{{$order->getProductsTitles()}}</td>

                            <td>{{$order->total}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->inDone()}}</td>




                            <td>
                                <a href="{{route('orders.edit',$order->id)}}" class="fa fa-pencil"></a>

                                {{Form::open(['route'=>['orders.destroy',$order->
                                    id],'method'=>'delete'])}}
                                <button onclick="return confirm('Желаете удалить?')" type="submit" class="delete">
                                    <i class="fa fa-remove"></i>
                            </button>


                            {{Form::close()}}
                            </td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection