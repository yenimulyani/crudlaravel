@extends('layout.template')
@section('judul')
Menampilkan Data uses_error
@endsection
@section('content')
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      @if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
      <form action="{{route('karyawan.store')}}" method="POST" enctype="multipart/form-data">
      

      {{csrf_field()}}
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{old('nama')}}" name="nama" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="{{ old('email')}}" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{old('alamat')}}" name="alamat" placeholder="Alamat">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-address-book"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="radio"  name="gender" placeholder="L" value="L">Laki-laki
          <input type="radio"  name="gender" placeholder="P" value="P">Perempuan
          <div class="input-group-append">
           
          </div>
        </div>
        <div class="input-group mb-3">
            <select name="status" id="" class="form-control" require>
                <option value="">Status User</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>          
        </div>
        <div class="input-group mb-3">
            <select name="jabatan" id="" class="form-control" require>
                <option value="" disabled selected>Pilih Jabatan</option>
                @foreach($jabatan as $row)
                <option value="{{$row->jabatan_id}}">{{$row->jabatan_nama}}</option>
                @endforeach
            </select>          
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
    </div>
    <!-- /.form-box -->
  </div>
@endsection