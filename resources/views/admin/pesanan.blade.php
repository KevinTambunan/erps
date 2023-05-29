@extends('admin.layout.dashboard')

<link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pesanan</h1>
        <p>Pesanan yang telah masuk</p>
        {{-- <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Tambah Akun Bank</button> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Nama Homestay</th>
                                <th>Tanggal Check in</th>
                                <th>Tanggal Check out</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homestay as $item)
                                @foreach ($item->pesanan as $pesanan)
                                <tr>
                                    <td>{{ $pesanan->pemesan->nama }}</td>
                                    <td>{{ $pesanan->homestay->nama }}</td>
                                    <td>{{ $pesanan->tanggal_mulai }}</td>
                                    <td>{{ $pesanan->tanggal_berakhir }}</td>
                                    <td>{{ $pesanan->status }}</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                            data-target="#tambahfoto{{ $pesanan->id }}">Edit</button> --}}
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#hapusfoto{{ $pesanan->id }}">detail</button>
                                    </td>
                                </tr>
                                {{-- <div class="modal fade" id="tambahfoto{{$pesanan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$pesanan->nama}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/pesanan/update/{{$pesanan->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $admin_id }}" name="admin_id">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Akun pesanan</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                            name="nama" value="{{$pesanan->nama}}">
                                                        <small id="emailHelp" class="form-text text-muted">Masukkan nama lengkap akun anda</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect2">Nama pesanan</label>
                                                        <select multiple class="form-control" id="exampleFormControlSelect2" name="nama_pesanan">
                                                            <option>BNI</option>
                                                            <option>BRI</option>
                                                            <option>Mandiri</option>
                                                            <option>BCA</option>
                                                            <option>pesanan Nobu</option>
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
                                </div> --}}
                                <div class="modal fade" id="hapusfoto{{ $pesanan->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab" data-toggle="tab"
                                                            data-target="#home{{$pesanan->id}}" type="button" role="tab"
                                                            aria-controls="home" aria-selected="true">Homestay</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-toggle="tab"
                                                            data-target="#profile{{$pesanan->id}}" type="button" role="tab"
                                                            aria-controls="profile" aria-selected="false">Pemesan</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="contact-tab" data-toggle="tab"
                                                            data-target="#contact{{$pesanan->id}}" type="button" role="tab"
                                                            aria-controls="contact" aria-selected="false">Pembayaran</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home{{$pesanan->id}}" role="tabpanel"
                                                        aria-labelledby="home-tab">
                                                        <h5 class="mt-3">Detail Homestay</h5>
                                                        <p><b>Nama Homestay :</b> {{$pesanan->homestay->nama}}</p>
                                                        <p><b>Alamat Homestay :</b> {{$pesanan->homestay->alamat}}</p>
                                                        <p><b>harga Homestay :</b> {{$pesanan->homestay->harga}}</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile{{$pesanan->id}}" role="tabpanel"
                                                        aria-labelledby="profile-tab">
                                                        <h5 class="mt-3">Detail Pemesan</h5>
                                                        <p><b>Nama Pemesan :</b> {{$pesanan->pemesan->nama}}</p>
                                                        <p><b>Alamat Pemesan :</b> {{$pesanan->pemesan->alamat}}</p>
                                                        <p><b>No telephone  :</b> {{$pesanan->pemesan->no_telephone}}</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="contact{{$pesanan->id}}" role="tabpanel"
                                                        aria-labelledby="contact-tab">
                                                        @if ($pesanan->status == 'diproses')
                                                            <h5 class="mt-3">Detail Pembayaran</h5>
                                                            <p><b>Nama Pengirim :</b> {{$pesanan->pemesan->nama}}</p>
                                                            <p><b>Total Harga :</b> {{$pesanan->total_harga}}</p>
                                                            <p><b>Bukti Pembayaran :</b> <a href="assets/images/{{$pesanan->pembayaran->bukti_pembayaran}}">Lihat Foto</a> <br></p>
                                                            <img src="{{asset('assets/images/'.$pesanan->pembayaran->bukti_pembayaran)}}" alt="" srcset="" style="max-width: 350px">

                                                            <form action="/pembayaran/konfirmasi/{{$pesanan->id}}" method="post">
                                                                @csrf
                                                                <h3>Anda yakin ingin konfirmasi pembayaran?</h3>
                                                                <input type="hidden" name="hidden">
                                                                <button type="submit" class="btn btn-primary btn-block">Yakin</button>
                                                            </form>
                                                        @elseif($pesanan->status == 'dikonfirmasi')
                                                            <h5 class="mt-3">Pembayaran telah dikonfirmasi</h5>
                                                        @elseif ($pesanan->status == 'menunggu pembayaran')
                                                            <h5 class="mt-3">Menunggu Pembayaran</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

<script src="{{ asset('assets/js/table.js') }}"></script>
<script src="{{ asset('assets/js/table2.js') }}"></script>
