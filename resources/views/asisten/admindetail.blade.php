@extends('/admin/app/app')
@section('title')
User Manage
@stop

@section('style')

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
        <h1>Admin Detail</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">E-bussines</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
            <h3 class="card-title">Detail</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            {!! Form::open(['url' => route('admin.adminpersonalUpdate')]) !!}
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Username</label>
                  <input type="email" class="form-control" name="username" placeholder="Username Using Email " id="username" value="{{$detail->username}}" required>
                  <input type="hidden" class="form-control" name="usernameOld" placeholder="Username Using Email " id="username" value="{{$detail->username}}" required>
                </div>
                <div class="form-group">
                  <label for="name">Full Name/ Nama Lengkap*</label>
                  <input class="form-control" placeholder="Nama Lengkap.." id="name" value="{{$detail->nama}}" name="nama">
                </div>
                <div class="form-group">
                  <label for="name">Alamat</label>
                  <input class="form-control" placeholder="Alamat.." id="name" value="{{$detail->alamat}}" name="alamat">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Kota</label>
                  <input class="form-control" placeholder="Kota.." id="" value="{{$detail->kota}}" name="kota" >
                </div>
                <div class="form-group">
                  <label for="name">Provinsi</label>
                  <input class="form-control" placeholder="Provinsi.." id="" value="{{$detail->provinsi}}" name="provinsi" >
                </div>
                <div class="form-group">
                  <label for="name">Kode Pos</label>
                  <input class="form-control" placeholder="Kode Pos.." id="" value="{{$detail->kode_pos}}" name="kode_pos" >
                </div>
                <div class="form-group">
                  <label for="name">No Tlp</label>
                  <input class="form-control" placeholder="No Tlp.." id="" value="{{$detail->no_tlp}}" name="no_tlp" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <br>
                  {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
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
