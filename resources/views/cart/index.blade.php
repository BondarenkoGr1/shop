@extends('layout')

@section('content')
    <script>
        $(document).ready(function(){
            <?php for($i=1;$i<20;$i++){?>
            $('#upCart<?php echo $i;?>').on('change keyup', function(){
                var newqty = $('#upCart<?php echo $i;?>').val();
                var rowId = $('#rowId<?php echo $i;?>').val();
                var proId = $('#proId<?php echo $i;?>').val();
                if(newqty <=0){ alert('enter only valid qty') }
                else {
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: '<?php echo url('/cart/update');?>/'+proId,
                        data: "qty=" + newqty + "& rowId=" + rowId + "& proId=" + proId,
                        success: function (response) {
                            console.log(response);
                            $('#updateDiv').html(response);
                        }
                    });
                }
            });
            <?php } ?>
        });
    </script>
    <style>
        .cart_description a:hover{
            color: #337ab7;
        }
    </style>
    <?php if ($cartItems->isEmpty()) { ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li class="active">Корзина</li>
                </ol>
            </div>
            <div align="center">  <img src="{{asset('images/empty-cart.png')}}"/></div>

        </div>
    </section> <!--/#cart_items-->

    <?php } else { ?>

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li class="active">Корзина</li>
                </ol>
            </div>

            <div id="updateDiv">
                @if(session('status'))
                    <div class="alert alert-success">

                        {{session('status')}}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">

                        {{session('error')}}
                    </div>
                @endif


                <div class="table-responsive cart_info" >
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Товар</td>
                            <td class="description"></td>
                            <td class="price">Стоимость</td>
                            <td class="quantity">Количество</td>
                            <td class="total">Итог</td>
                            <td></td>
                        </tr>
                        </thead>
                        <?php $count =1;?>
                        @foreach($cartItems as $cartItem)


                            <tbody>

                            <tr>
                                <td class="cart_product">
                                    <a href="{{url('/post/{slug}')}}/{{$cartItem->id}}"><img src="/uploads/{{$cartItem->options->img}}" alt="" width="200px"></a>
                                </td>
                                <td class="cart_description" >
                                    <h4><a href="{{url('/post/{slug}')}}/{{$cartItem->id}}" style="color: #333333;text-decoration: none;">{{$cartItem->name}}</a></h4>
                                    {{--<p>Product ID: {{$cartItem->id}}</p>--}}
                                </td>
                                <td class="cart_price">
                                    <p>{{$cartItem->price}} грн</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">

                                        <input type="hidden" id="rowId<?php echo $count;?>" value="{{$cartItem->rowId}}"/>
                                        <input type="hidden" id="proId<?php echo $count;?>" value="{{$cartItem->id}}"/>

                                        <input type="number" size="2" value="{{$cartItem->qty}}" name="qty" id="upCart<?php echo $count;?>"
                                               autocomplete="off" style="text-align:center; max-width:50px; "  MIN="1" MAX="30">


                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{$cartItem->subtotal}} грн</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" style="background-color:red"
                                       href="{{url('/cart/remove')}}/{{$cartItem->rowId}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                            <?php $count++;?>
                            </tbody>  @endforeach
                    </table>
                </div>

            </div>


        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            @include('admin.errors')
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <form action="/checkout" method="post">
                            {{ csrf_field() }}
                            <ul class="user_info">
                                <li class="single_field" style="width: 41%">
                                    <label style="margin-left: 17%">Способ оплаты</label>
                                    <select name="payments_id">
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->title }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li class="single_field" style="width: 41%;">
                                    <label style="margin-left: 17%">Адрес:</label>
                                    <input type="text" name="address">
                                </li>
                            </ul>
                            <button class="btn btn-default check_out" style="margin-left: 7%">Оформить заказ</button>
                        </form>

                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li style="background-color: #F0F0E9">Товаров на сумму <span>{{Cart::subtotal()}} грн</span></li>
                        </ul>
                        <a class="btn btn-default update" href="" style="margin-left: 10%">Обновить</a>
                    </div>
                </div>


            </div>

        </div>
    </section><!--/#do_action-->


    <?php } ?>
    <!-- end main content-->
@endsection