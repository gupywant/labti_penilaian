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
        <h1>Produk List</h1>
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
    @if(Session::get('role')=="sales")
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="float-sm-left">
              <h3 class="card-title">List</h3>
            </div>
            <div class="float-sm-right">
              <form class="form-inline ml-3" method="get">
                <div class="input-group input-group-sm">
                  <label>Kategori : </label>
                  <select name="kategori" class="form-control form-control-sm">
                    <option value="">All</option>
                    @foreach($kategori as $key => $kat)
                      <option value="{{$kat->kategori}}" @if(isset($_GET['kategori'])) @if($_GET['kategori']==$kat->kategori) selected @endif @endif>{{$kat->kategori}}</option>
                    @endforeach
                  </select>
                  &nbsp;
                  <input class="form-control form-control-navbar" type="search by nama" placeholder="Search by nama" value="{{$search}}" name="search" aria-label="Search by nama">
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
                    <th width="30%">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Stock</th>
                    <th>Harga Jual</th>
                    <th>Kategori</th>
                    <th>Detail</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Stock</th>
                    <th>Harga Jual</th>
                    <th>Kategori</th>
                    <th>Detail</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($produk as $key => $data)
                    <tr>
                      <td>{{$produk->firstItem() + $key}}</td>
                      <td><img src="{{ URL::asset('files/'.$data->id_produk.'/'.$data->image)}}" width="40%" height="40%"></td>
                      <td>{{$data->nama_produk}}</td>
                      <td>{{$data->stock}}</td>
                      <td>{{number_format($data->harga,0,',','.')}}</td>
                      <td>{{$data->kategori}}</td>
                      <td><a href="{{route('admin.liveDetail',$data->id_produk)}}" target="_blank">Detail/ Edit</a></td>
                      <td>
                        @if($data->status==1)
                          <a href="{{route('admin.liveUpdate',$data->id_produk)}}"><font color="green"><i class="fa fa-eye"></i></font></a>
                        @elseif($data->status==0)
                          <a href="{{route('admin.liveUpdate',$data->id_produk)}}"><font color="red"><i class="fa fa-eye-slash"></i></font></a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $produk->links() }}
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    @endif
  </div>
  <!-- /.container-fluid -->
</section>
@endsection