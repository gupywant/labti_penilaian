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
        <h1>List Nilai</h1>
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
        <p>*Upload file excel dari web labti kesini</p>
        <form action="{{route('admin.import')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
           <div class="form-group">
            <label for="sel1">Tipe File:</label>
            <select class="form-control" name="tipe" id="sel1">
              <option value="tp">Pre test - TP</option>
              <option value="lp">Post test - LP</option>
            </select>
          </div>
          <label>Upload File</label>
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
              <span>Choose file</span>
              <input type="file" name="file">
              <input type="hidden" name="session" value="{!!session('id_urut')!!}">
            </div>
          </div>
          <input type="submit" class="btn btn-warning" value="upload" name="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <!--<div class="float-sm-left">
                <h5>Nilai LA Kelas {{--$p->kelas--}} - {{--$p->nama_praktikum--}}</h5>
              </div>-->
              <button value="Tambah Praktikum" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Import Excel</button>
              <div class="float-sm-right">
                <h5>Nilai Asli</h5>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <!--<div class="float-sm-left">
                        <h5>Nilai LA Kelas {{--$p->kelas--}} - {{--$p->nama_praktikum--}}</h5>
                      </div>-->
                      <div class="float-sm-right">
                        <h5>Nilai Convert</h5>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="nilai" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NPM</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>TP</th>
                              <th>LP</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>NPM</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>TP</th>
                              <th>LP</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            <?php $no = 1; ?>
                            @foreach($nilai as $key => $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->npm}}</td>
                              <td>{{$data->nama}}</td>
                              <td>{{$data->kelas}}</td>
                              <td>{{$data->tp}}</td>
                              <td>{{$data->lp}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <!--<div class="float-sm-left">
                        <h5>Nilai LA Kelas {{--$p->kelas--}} - {{--$p->nama_praktikum--}}</h5>
                      </div>-->
                      <div class="float-sm-right">
                        <h5>Nilai Asli</h5>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="nilaiasli" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NPM</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>TP</th>
                              <th>LP</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>NPM</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>TP</th>
                              <th>LP</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            <?php $no = 1; ?>
                            @foreach($nilai as $key => $data)
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$data->npm}}</td>
                              <td>{{$data->nama}}</td>
                              <td>{{$data->kelas}}</td>
                              <td>{{$data->tp/3.0}}</td>
                              <td>{{$data->lp/2.0}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
@endsection