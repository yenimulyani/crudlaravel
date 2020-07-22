@extends('layout.template')
@section('judul')
Ubah user
@endsection
@section('content')
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Data Profile User</p>
      @if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="{{$data_user->karyawan_image}}" alt="User profile picture">
    <form method="post" enctype="multipart/form-data" action="{{route('profile.gambar')}}">
    @csrf
        <input type="hidden" value="{{$data_user->karyawan_id}}" name="karyawan_id"/>
        <input type="file" class="btn btn-default" name="image"/>
    <input type="submit" class="btn btn-primary" value='ubah foto'/>
    </form>
    <h3 class="profile-username text-center">{{$data_user->karyawan_nama }}</h3>
    <h3 class="profile-username text-center">{{$data_user->jabatan_nama }}</h3>

    <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Jenis Kelamin</b> <a class="float-right">{{$data_user->karyawan_gender}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>
</div>


      <form action="{{route('profile.ubah', $data_user->karyawan_id)}}" method="POST">


      {{csrf_field()}}
      @method('PATCH')
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{$data_user->karyawan_nama}}" name="nama" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="{{$data_user->username}}" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{$data_user->karyawan_alamat}}" name="alamat" placeholder="Alamat">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-address-book"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="radio" {{($data_user->karyawan_gender=='L')?'checked':''}} name="gender" placeholder="L" value="L">Laki-laki
          <input type="radio" {{($data_user->karyawan_gender=='P')?'checked':''}} name="gender" placeholder="P" value="L">Perempuan

          <div class="input-group-append">

          </div>
        </div>


        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.form-box -->
  </div>
@endsection
