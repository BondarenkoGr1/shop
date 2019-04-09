@extends('layout')

@section('content')
    <script>
        $(document).ready(function () {
            <?php $maxP = count($products);
            for ($i = 0; $i < $maxP; $i++) { ?>
            $('#successMsg<?= $i ?>').hide();
            $('#cartBtn<?= $i ?>').on('click', function () {
                var pro_id<?= $i ?> = $('#pro_id<?= $i ?>').val();

                $.ajax({
                    type: 'get',
                    url: '<?= url('/cart/addItem') ?>/' + pro_id<?= $i ?>,
                    success: function () {
                        $('#cartBtn<?= $i ?>').hide();
                        $('#successMsg<?= $i ?>').show();
                        $('#successMsg<?= $i ?>').append('Товар добавлен в корзину');
                    }
                });
            });
            <?php } ?>
        });
    </script>
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(!count($products))
                        <div class="alert alert-info ">
                            К сожалению в данной категории пока нет товаров, ожидайте :(
                        </div>
                    @endif
                    <div class="row">
                    @php $countP = 0; @endphp
                    @foreach($products as $product)

                            <input type="hidden" id="pro_id{{ $countP }}" value="{{ $product->id }}">
                            <div class="col-md-6">
                            <article class="post post-grid">
                                <div class="post-thumb">
                                    <a href="{{route('post.show',$product->slug)}}"><img src="{{$product->getImage()}}" alt=""></a>

                                    <a href="{{route('post.show',$product->slug)}}" class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">Просмотр</div>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <header class="entry-header text-center text-uppercase">
                                        @if($product->hasCategory())
                                            <h6><a href="{{route('category.show',$product->category->slug)}}">{{$product->getCategoryTitle()}}</a></h6>
                                        @endif

                                        <h1 class="entry-title"><a href="{{route('post.show',$product->slug)}}">{{$product->name}}</a></h1>


                                    </header>
                                    <div class="entry-content">
                                        <p>
                                            {!! $product->description !!}
                                        </p>
                                        <p>
                                            Цена:{{$product->price}}
                                        </p>
                                        <div class="btn-continue-reading text-center">
                                            <button class="more-link text-uppercase add-to-cart" id="cartBtn{{ $countP }}">В корзину</button>
                                            <div id="successMsg{{ $countP }}" class="alert alert-success"></div>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </div>
                        @php $countP++ @endphp
                        @endforeach
                    </div>
                    {{$products->links()}}
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection