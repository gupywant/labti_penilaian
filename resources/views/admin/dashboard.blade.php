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
        <h1>Admin Dashboard</h1>
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
            <h3 class="card-title">Admin</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <h5><strong>Welcomeeeeeeeee</strong></h5>
            <p>
              <h5><strong>Tutorial PJ :</strong><h5><br>
                https://drive.google.com/open?id=1uVKkUd2pMmqeo7h1OH47ALap93ctZGpB (vidio)<br><br>

                <strong>Web : </strong><br>
                http://ti.lab.gunadarma.ac.id/praktikum<br><br>

                <strong>Note : </strong><br>
                1. Statistika 3 pertemuan<br>
                2. Pj membuat pre test(tp) post test(lp) dan activity<br>
                3. Diminggu berikutnya praktikan upload LA di acitivity sesuai minggunya (misal LA minggu 1 baru bisa diupload di minggu 2 dan uploadnya di activity minggu 1)<br>
                4. Pj membuat forum dan mereply forum (forum bisa berisi pertanyaan, boleh buat nilai k)<br>
                5. Untuk nilai K pj membuat acitivity lainnya yg nanti praktikan mengupload tugas yang diberikan pj<br>
                6. Setelah praktikan mengunggah la, pj harus mendownloadnya dari web dan membagikannya kepada asisten yang berjaga.<br>
                7. Asisten memeriksa LA yang diberikan pj dan menyetor nilainya kepada PJ<br>
                8. PJ memasukkan nilai LA yang didapat dari asisten ke dalam web.<br>
                9. PJ membuat materi dalam bentuk video dan mengupload ke youtube paling lambat h-1 sebelum praktikum dan menyertakan linknya di dalam Pertemuan.<br><br>

                Untuk range nilai disistem web 1-10, dan untuk menghitung nilai yang benar secara manual:<br>
                TP : 3.0 * 10<br>
                LP : 2.0 * 10<br>
                LA : 1.5 * 10<br>
                K : 3.5 * 10<br>
            </p>
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