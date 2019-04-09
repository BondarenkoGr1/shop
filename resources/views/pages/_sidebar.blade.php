<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Категории</h3>
            <ul>
                @foreach($categories as $category)
                <li>
                    <a href="{{route('category.show',$category->slug)}}">{{$category->title}}</a>
                    <span class="post-count pull-right">({{$category->products()->count()}})</span>
                </li>
                @endforeach
            </ul>
        </aside>
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Популярное</h3>

            <div id="widget-feature" class="owl-carousel">
                @foreach($featuredProducts as $product)
                <div class="item">
                    <div class="feature-content">
                        <img src="{{$product->getImage()}}" alt="">

                        <a href="{{route('category.show',$category->slug)}}" class="overlay-text text-center">
                            <h5 class="text-uppercase">{{$product->name}}</h5>

                            <p>{!! $product->desciption !!}</p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </aside>


    </div>
</div>