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
          <li class="breadcrumb-item active">List Praktikum</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@foreach($nilai as $data)
<div id="myModal{{$data['id_nilai']}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{$data->nama}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="{{route('asisten.edit')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="npm" value="{{$data->npm}}">
          <input type="hidden" name="id_praktikum" value="{{$data->id_praktikum}}">
          <input type="hidden" name="id_nilai" value="{{$data->id_nilai}}">
          @for($i=1;$i<=(int)$p->pertemuan;$i++)
            <div class="form-group">
              <label>Pertemuan {{$i}}</label><br>
              <input style="width: 100%;" value="{{$data['p'.$i]}}" placeholder="nilai pert {{$i}}" type="number" name="p{{$i}}" id="praktikum" class="form-control form-control-navbar" required="">
            </div>
          @endfor
          <div class="form-group">
            <input style="width: 100%;" type="submit" value="Update" name="submit" id="praktikum" class="form-control btn btn-success" required="">
          </div>
        </form>
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
              <h5>Nilai LA Kelas {{$p->kelas}} - {{$p->nama_praktikum}}</h5>
            </div>
            <div class="float-sm-right">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    @for($i=1;$i<=(int)$p->pertemuan;$i++)
                      <th>Pertemuan {{$i}}</th>
                    @endfor
                    <th>Edit Nilai</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    @for($i=1;$i<=(int)$p->pertemuan;$i++)
                      <th>Pertemuan {{$i}}</th>
                    @endfor
                    <th>Edit Nilai</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no = 1; ?>
                  @foreach($nilai as $key => $data)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data['npm']}}</td>
                    <td>{{$data['nama']}}</td>
                    <td>{{$data['kelas']}}</td>
                    @for($i=1;$i<=(int)$p->pertemuan;$i++)
                    <td><?= $data['p'.$i] ?></td>
                    @endfor
                    <td><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal{{$data['id_nilai']}}"><i class="fa fa-pen"></i></button></td>
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
      <!-- /.col -->
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
@endsection