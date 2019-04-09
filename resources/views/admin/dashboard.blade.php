@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Администраторская часть сайта
            <small>если ты сюда попал,ты высокоуважаемый человек</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Небольшая инструкция использования</h3>
            </div>
            <div class="box-body">
                <b>В этой административной панели: мы можем работать с деревом сайта (пункты меню): обновлять, удалять, добавлять, скрывать и т.п.</b>
                <p>Для изменения содержимого любой страницы необходимо редактировать соответствующий раздел пункта меню</p>
                <img src="/images/sidebar.png" alt="menu">
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <p>Справа в верхнем углу находится кнопка “Настройки” - для настройки (персонализации) администраторской стороны сайта в ваших удобствах.</p>
                <img src="/images/settings.png" alt="settings">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
@endsection