@extends('admin.layout.dashboard')

<link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Profile</h1>
        <p>Profile anda</p>
        @if ($admin->no_telephone == 0)
            <a class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Lengkapi Profil</a>
            {{-- <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Lengkapi Profil</button> --}}
        @else
            <a class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Update Profil</a>

        @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p>Nama</p>
                            <p>Telephone</p>
                            <p>Email</p>
                            <p>Alamat</p>
                        </div>
                        <div class="col-md-4">
                            <p> : {{ $admin->nama }}</p>
                            <p> : {{ $admin->no_telephone }}</p>
                            <p> : {{ Auth::user()->email }}</p>
                            <p> : {{ $admin->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>



    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Homestay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/profile_admin/update" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="nama" value="{{$admin->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">no_telephone</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="no_telephone" value="{{$admin->no_telephone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">email</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="email" value="{{Auth::user()->email}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{$admin->alamat}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/js/table.js') }}"></script>
<script src="{{ asset('assets/js/table2.js') }}"></script>
