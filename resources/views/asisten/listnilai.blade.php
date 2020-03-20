@extends('asisten/app_dash/app')
@section('title')
User Manage
@stop
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="col-sm-12">
      @if(session('alert'))
        <br>
        <div class="alert alert-info" role="alert">
        {!!session('alert')!!}
        </div>
        <hr>
      @endif
    </div>
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Nilai</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Penilaian LA</a></li>
          <li class="breadcrumb-item active">List Nilai LA</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="float-sm-left">
              <h5>List Nilai praktikum</h5>
            </div>
            <div class="float-sm-right">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Praktikum</th>
                    <th>Detail</th> 
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Praktikum</th>
                    <th>Detail</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($list as $data)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->kelas}}</td>
                    <td>{{$data->nama_praktikum}}</td>
                    <td><a href="{{route('asisten.nilai',$data->id_praktikum)}}" class="btn btn-info btn-sm"  target="_blank">Detail</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $list->links() }}
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
@endsection