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
        <h1>List File LA</h1>
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

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="float-sm-left">
              <h5>File LA Kelas {{$p->kelas}} - {{$p->nama_praktikum}}</h5>
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
                    <th>Pertemuan</th>
                    <th>Download LA</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Pertemuan</th>
                    <th>Download LA</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no = 1; ?>
                  @for($i=1;$i<=(int)$p->pertemuan;$i++)
                  <tr>
                    <td>Pertemuan {{$i}}</td>
                    <td><a href="@if($file[$i-1]->file=='#') # @else {{route('asisten.download',$file[$i-1]->id_la)}} @endif" class="btn btn-warning btn-sm"><i class="fa fa-download"></i>download</a></td>
                  </tr>
                  @endfor
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