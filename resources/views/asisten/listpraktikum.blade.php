@extends('admin/app_dash/app')
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
        <h1>List Praktikum</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Penilaian LA</a></li>
          <li class="breadcrumb-item active">List Praktikum</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-sm-left">Tambah Praktikum</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="{{route('admin.praktikumAdd')}}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Kelas </label><br/>
            <select name="kelas" class="form-control form-control-sm" required="">
              @foreach($kelas as $data)
                <option value="{{$data->kelas}}">{{$data->kelas}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Praktium </label><br>
            <input style="width: 100%;" placeholder="nama praktikum" type="text" name="nama_praktikum" id="praktikum" class="form-control form-control-navbar" required="">
          </div>
          <div class="form-group">
            <label>Jumlah Pertemuan </label><br>
            <input style="width: 100%;" placeholder="Jumlah Pertemuan" type="number" name="pertemuan" id="praktikum" class="form-control form-control-navbar" required="">
          </div>
          <div class="form-group">
            <input style="width: 100%;" type="submit" value="Tambah" name="submit" id="praktikum" class="form-control btn btn-success" required="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- modal for detail -->
@foreach($list as $data)
<div id="modal{{$data->id_praktikum}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Praktikum</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
        <form class="form-group" action="{{route('admin.praktikumAdd')}}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Mata Praktikum </label><br>
            <input style="width: 100%;" placeholder="Mata Praktikum" type="text" name="nama_praktikum" id="praktikum" value="{{$data->nama_praktikum}}" class="form-control form-control-navbar" required="">
          </div>
          <div class="form-group">
            <label>Kelas </label><br>
            <input style="width: 100%;" placeholder="Kelas" type="text" name="kelas" id="praktikum" value="{{$data->kelas}}" class="form-control form-control-navbar" required="">
          </div>
          <div class="form-group">
            <label>Jumlah Pertemuan </label><br>
            <input style="width: 100%;" placeholder="Mata Praktikum" type="number" name="pertemuan" id="praktikum" value="{{$data->pertemuan}}" class="form-control form-control-navbar" required="">
          </div>
        </form>
        <a href="{{route('admin.userReset',$data->id_praktikum)}}">Reset User</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endforeach

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="float-sm-left">
              <input type="submit" value="Tambah Praktikum" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
            </div>
            <div class="float-sm-right">
              <form class="form-inline ml-3" method="get">
                <div class="input-group input-group-sm">
                  <label>Kelas : </label>
                  <select name="kategori" class="form-control form-control-sm">
                    <option value="">All</option>
                    @foreach($kelas as $data)
                      <option value="{{$data->kelas}}">{{$data->kelas}}</option>
                    @endforeach
                  </select>
                  &nbsp;
                  <input class="form-control form-control-navbar" type="search by nama" placeholder="Cari praktikum" value="" name="search" aria-label="Search by nama">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
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
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Praktikum</th>
                    <th>Detail</th>
                    <th>Delete<th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($list as $key => $data)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->kelas}}</td>
                    <td>{{$data->nama_praktikum}}</td>
                    <td><input type="submit" value="Detail" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal{{$data->id_praktikum}}"></td>
                    <td><a href="{{route('admin.delete',$data->id_praktikum)}}" class="btn btn-danger btn-sm">Delete</td>
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