@extends('layout')

@section('content')
    <!--main content start-->
    <style>
        th{
            text-align:center;
        }
    </style>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                        @if(!count($orders))
                            <div class="alert alert-info ">
                                К сожалению у вас пока нет заказов! :(
                            </div>
                            @endif

                    <article class="post">
                        <div class="post-content">

                            <header class="entry-header text-center text-uppercase">
                                <h1 class="entry-title"><a href="blog.html">Мои заказы</a></h1>
                            </header>
                            {{Form::open([
                                   'route'=>'orders.store',
                                   'files'=> true
                               ])}}
                            <div class="entry-content">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Номер заказа</th>
                                        <th>Товары</th>
                                        <th>Адрес</th>
                                        <th>Способ оплаты</th>
                                        <th>Сумма заказа</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->getProductsTitles()}}</td>
                                            <td>{{$order->address}}</td>
                                            <td>{{$order->getPaymentTitle()}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->inDone()}}</td>
                                        </tr>
                                    @endforeach
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </article>
                </div>
                @include('pages._sidebar')
            </div>
            {{Form::close()}}
        </div>
    </div>
    <!-- end main content-->
@endsection