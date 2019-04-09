@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      {{Form::open([
          'route' => 'payments.store',
          'files' => true
      ])}}
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              @include('admin.errors')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('payments.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
	                <tr>
	                  <td>{{$payment->id}}</td>
	                  <td>{{$payment->title}}</td>
	                  <td><a href="{{route('payments.edit', $payment->id)}}" class="fa fa-pencil"></a>

                        {{Form::open(['route'=>['payments.destroy',$payment->id],'method'=>'delete'])}}
                        <button onclick="return confirm('Желаете удалить?')" type="submit" class="delete">
                          <i class="fa fa-remove"></i></td>
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