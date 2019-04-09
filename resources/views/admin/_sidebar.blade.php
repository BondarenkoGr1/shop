<ul class="sidebar-menu">
    <li><a href="/"><span>Перейти на сайт</span></a></li>
    <li><a href="{{route('orders.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Заказы</span></a></li>
    <li><a href="{{route('categories.index')}}"><i class="fa fa-list-ul"></i> <span>Категории</span></a></li>
    <li><a href="{{route('product.index')}}"><i class="fa fa-tags"></i> <span>Товары</span></a></li>
    <li><a href="{{route('payments.index')}}"><i class="fa fa-tags"></i> <span>Оплата</span></a></li>
    <li>
        <a href="/admin/comments">
            <i class="fa fa-commenting"></i> <span>Комментарии</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$newCommentsCount}}</small>
            </span>
        </a>
    </li>
    <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>


</ul>