@extends('layout')

@section('content')
    <script>
        $(document).ready(function () {
            $('#successMsg').hide();
            $('#cartBtn').on('click', function () {
                var pro_id = $('#pro_id').val();

                $.ajax({
                    type: 'get',
                    url: '<?= url('/cart/addItem') ?>/' + pro_id,
                    success: function () {
                        $('#cartBtn').hide();
                        $('#successMsg').show();
                        $('#successMsg').append('Товар добавлен в корзину');
                    }
                });
            });
        });
    </script>
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                        <input type="hidden" id="pro_id" value="{{ $product->id }}">
                        <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('post.show',$product->slug)}}"><img src="{{$product->getImage()}}" alt="" ></a>
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

                            </div>
                            <p>
                                Цена:{{$product->price}}
                            </p>
                            <div class="decoration text-center">
                                <button class="more-link text-uppercase add-to-cart" id="cartBtn">В корзину</button>
                                <div id="successMsg" class="alert alert-success"></div>
                            </div>

                            <div class="social-share">
							<ul class="text-center pull-right">
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-instagram" href="https://www.instagram.com/rucola_cafe/"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    <div class="row"><!--blog next previous-->
                        <div class="col-md-6">
                            @if($product->hasPrevious())
                            <div class="single-blog-box">
                                <a href="{{route('post.show',$product->getPrevious()->slug)}}">
                                    <img src="{{$product->getPrevious()->getImage()}}" alt="">

                                    <div class="overlay">

                                        <div class="promo-text">
                                            <p><i class=" pull-left fa fa-angle-left"></i></p>
                                            <h5>{{$product->getPrevious()->name}}</h5>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($product->hasNext())
                            <div class="single-blog-box">
                                <a href="{{route('post.show',$product->getNext()->slug)}}">
                                    <img src="{{$product->getNext()->getImage()}}" alt="">

                                    <div class="overlay">
                                        <div class="promo-text">
                                            <p><i class=" pull-right fa fa-angle-right"></i></p>
                                            <h5>{{$product->getNext()->name}}</h5>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div><!--blog next previous end-->
                    <div class="related-post-carousel"><!--related post carousel-->
                        <div class="related-heading">
                            <h4>Попробуйте так же другие товары</h4>
                        </div>
                        <div class="items">
                            @foreach($product->related() as $item)
                            <div class="single-item">
                                <a href="{{route('post.show',$item->slug)}}">
                                    <img src="{{$item->getImage()}}" alt="">

                                    <p>{{$item->name}}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div><!--related post carousel-->
                        @if(!$product->comments->isEmpty())
                            @foreach($product->getComments() as $comment)
                    <div class="bottom-comment"><!--bottom comment-->

                        <div class="comment-img">
                            <img class="img-circle" src="{{$comment->author->getImage()}}" alt="" width="60" height="60">
                        </div>

                        <div class="comment-text">
                            <h5>{{$comment->author->name}}</h5>

                            <p class="comment-date">
                                {{$comment->created_at->diffForHumans()}}
                            </p>


                            <p class="para">
                                {{$comment->text}}
                            </p>
                        </div>
                    </div>
                    <!-- end bottom comment-->
                            @endforeach
                       @endif

                    @if(Auth::check())
                    <div class="leave-comment"><!--leave comment-->
                        <h4>Оставьте отзыв</h4>


                        <form class="form-horizontal contact-form" role="form" method="post" action="/comment">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="form-group">
                                <div class="col-md-12">
										<textarea class="form-control" rows="6" name="message"
                                                  placeholder="Написать сообщение"></textarea>
                                </div>
                            </div>
                            <button class="btn send-btn">Опубликовать</button>
                        </form>
                    </div><!--end leave comment-->
                    @endif
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection