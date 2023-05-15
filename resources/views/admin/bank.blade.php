@extends('admin.layout.dashboard')

<link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Akun Bank</h1>
        <p>Akun Bank yang anda miliki</p>
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Tambah Akun Bank</button>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Homestay</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Bank</th>
                                <th>Nama Pemilik</th>
                                <th>Nomor Rekening</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                                <tr>
                                    <td>{{ $bank->nama_bank }}</td>
                                    <td>{{ $bank->nama }}</td>
                                    <td>{{ $bank->nomor_rekening }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahfoto{{$bank->id}}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hapusfoto{{$bank->id}}">Hapus</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="tambahfoto{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$bank->nama}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/bank/update/{{$bank->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $admin_id }}" name="admin_id">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Akun Bank</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                            name="nama" value="{{$bank->nama}}">
                                                        <small id="emailHelp" class="form-text text-muted">Masukkan nama lengkap akun anda</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect2">Nama Bank</label>
                                                        <select multiple class="form-control" id="exampleFormControlSelect2" name="nama_bank">
                                                            <option>BNI</option>
                                                            <option>BRI</option>
                                                            <option>Mandiri</option>
                                                            <option>BCA</option>
                                                            <option>Bank Nobu</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nomor_rekening">Nomor Rekening</label>
                                                        <input type="number" class="form-control" id="nomor_rekening" name="nomor_rekening"  value="{{$bank->nomor_rekening}}">
                                                        <small id="emailHelp" class="form-text text-muted">Pastikan nomor rekening benar</small>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="hapusfoto{{$bank->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus {{$bank->nama}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/bank/destroy/{{$bank->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $admin_id }}" name="admin_id">
                                                    <h4>Anda yakin ingin menghapus akun bank {{$bank->nama}} ??</h4>
                                                    <button type="submit" class="btn btn-primary btn-block">Ya</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- @foreach ($homestays as $homestay)
                                <tr>
                                    <td>{{$homestay->nama}}</td>
                                    <td>{{$homestay->alamat}}</td>
                                    <td>{{$homestay->rating}} / 5</td>
                                    <td>{{$homestay->harga}}</td>
                                    <td>
                                        <a href="assets/images/{{$homestay->gambar}}">{{$homestay->gambar}}</a> <br>
                                        @foreach ($homestay->foto as $item)
                                            <a href="assets/images/{{$item['nama']}}">{{$item['nama']}}</a> <br>
                                        @endforeach
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahfoto{{$homestay->id}}">Tambah Foto</button>
                                    </td>
                                    <div class="modal fade" id="tambahfoto{{$homestay->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Foto {{$homestay->nama}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="/homestay/foto/{{$homestay->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div id="product_image">
                                                            <div class="custom-file mb-3">
                                                                <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                                    name="gambar[]">
                                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                            </div>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                                    name="gambar[]">
                                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                            </div>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                                    name="gambar[]">
                                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4 mr-1">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal{{$homestay->id}}">Edit</button>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="/homestay/destroy/{{$homestay->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal fade" id="exampleModal{{$homestay->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{$homestay->nama}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="/homestay/update/{{$homestay->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nama Homestay</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                name="nama" value="{{$homestay->nama}}">
                                                            <small id="emailHelp" class="form-text text-muted">Berikan nama yang bagus untuk homestay
                                                                anda!</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{$homestay->alamat}}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="harga">Harga</label>
                                                            <input type="number" class="form-control" id="harga" name="harga" value="{{$homestay->harga}}">
                                                            <small id="emailHelp" class="form-text text-muted">Harga homestay perhari</small>
                                                        </div>

                                                        <div class="custom-file mb-5">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                                name="gambar">
                                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                            <small id="emailHelp" class="form-text text-muted">Optional</small>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/bank/store" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $admin_id }}" name="admin_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Akun Bank</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="nama">
                            <small id="emailHelp" class="form-text text-muted">Masukkan nama lengkap akun anda</small>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Nama Bank</label>
                            <select multiple class="form-control" id="exampleFormControlSelect2" name="nama_bank">
                                <option>BNI</option>
                                <option>BRI</option>
                                <option>Mandiri</option>
                                <option>BCA</option>
                                <option>Bank Nobu</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nomor_rekening">Nomor Rekening</label>
                            <input type="number" class="form-control" id="nomor_rekening" name="nomor_rekening">
                            <small id="emailHelp" class="form-text text-muted">Pastikan nomor rekening benar</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/js/table.js') }}"></script>
<script src="{{ asset('assets/js/table2.js') }}"></script>
