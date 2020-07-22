@extends('layout.template')
@section('judul')
Menampilkan Data uses_error
@endsection
@section('content')
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>


    <a href="{{route('karyawan.create')}}" class="btn btn-success">Tambah</a>
    </div>
    <!-- /.form-box -->

    <button></button>
    <table border="1">
    <tr>

    <th>No</th>
    <th>Aksi</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Gender</th>
    <th>Status</th>
    <th>Foto</th>
    </tr>
    <tbody>
    @php
    $no=1;
    @endphp
    @foreach($karyawan as $row)
    <tr>
    <td>{{$no}}</td>
    <td>

         <form action="{{route('karyawan.destroy', $row->karyawan_id )}}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
         <a href="{{ route('karyawan.edit', $row->karyawan_id)}}" class="btn btn-warning">Edit</a> |
            <button class="btn btn-danger" type="submit" onclick="return confirm('Data Akan dihapus')">Hapus</button>
         </form>
    </td>

    <td>{{$row->karyawan_nama}}</td>
    <td>{{$row->karyawan_alamat}}</td>
    <td>{{$row->karyawan_gender}}</td>


    <td>
    @if($row->status==1)
        <div class="bg-success">Aktif
        </div>
    @else
    <div class="card bg-danger">Tidak Aktif
        </div>
    @endif
    </td>
    <td><img src="{{$row->karyawan_image}}" width="100px" alt=""></td>
    </tr>
    @php $no++ @endphp
    @endforeach
    </tbody>
    </table>
  </div>
@endsection
