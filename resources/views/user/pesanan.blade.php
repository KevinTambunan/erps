@extends('user.layouts.user')

<link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@section('content')
    <header class="py-2">
        <div class="container px-5 pb-5">
            <div class="row">
                <h5 class="mb-2">Pesanan anda</h5>
                @if (count($pesanans) > 0)
                    @foreach ($pesanans as $pesanan)
                        <div class="card col-md-3 border-0">
                            <img src="{{ asset('assets/images/' . $pesanan->homestay->gambar) }}" class="card-img-top"
                                alt="..." style="height:250px; object-fit: cover;">
                            <div class="m-1">
                                <p class="card-title fw-bold">{{ $pesanan->homestay->nama }}</h6>
                                <p class="card-text"
                                    style="line-height: 1.2; height: calc(1.2em * 2); overflow: hidden; margin-bottom:0px;">
                                    {{ $pesanan->homestay->alamat }}</p>
                                <p class="card-text text-danger mb-3" style="margin-bottom:0px;">Rp.
                                    {{ $pesanan->homestay->harga }}
                                    / Malam
                                </p>
                                <div class="row">
                                    @if ($pesanan->status == 'menunggu pembayaran')
                                        <div class="col-md-8">
                                            {{-- <a href="" class="btn btn-primary btn-block">Bayar Sekarang</a> --}}
                                            <a type="button" class="btn btn-block btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $pesanan->id }}">Bayar Sekarang</a>
                                        </div>
                                    @else
                                        <div class="col-md-8">
                                            {{-- <a href="" class="btn btn-primary btn-block">Bayar Sekarang</a> --}}
                                            <a class="btn btn-block btn-success">{{ $pesanan->status }}</a>
                                        </div>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $pesanan->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bayar Pesanan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="/pembayaran/create/{{ $pesanan->pemesan_id }}/{{ $pesanan->homestay->pemilik->bank[0]->id }}/{{ $pesanan->id }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <h6>Detail Pesanan</h6>
                                                        <div class="form-group mb-2">
                                                            <label for="nama">Nama Homestay</label>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" value="{{ $pesanan->homestay->nama }}"
                                                                disabled>
                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="tanggal_mulai">Tanggal Mulai</label>
                                                            <input type="date" class="form-control" id="tanggal_mulai"
                                                                name="tanggal_mulai" value="{{ $pesanan->tanggal_mulai }}"
                                                                disabled>
                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="tanggal_berakhir">Tanggal Berakhir</label>
                                                            <input type="date" class="form-control" id="tanggal_berakhir"
                                                                name="tanggal_berakhir"
                                                                value="{{ $pesanan->tanggal_berakhir }}" disabled>
                                                        </div>
                                                        {{--
                                                <div class="form-group mb-2">
                                                    <label for="total_harga">Total Harga</label>
                                                    <input type="number" class="form-control" id="total_harga"
                                                        name="total_harga" value="{{$pesanan->total_harga}}" disabled>
                                                </div> --}}

                                                        <h6 class="mb-3 mt-5">Pembayaran</h6>
                                                        <div class="form-group mb-2">
                                                            <label for="total_harga">Total Harga</label>
                                                            <input type="number" class="form-control" id="total_harga"
                                                                name="total_harga" value="{{ $pesanan->total_harga }}"
                                                                disabled>
                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="total_harga">Bank Tujuan</label>
                                                            <input type="text" class="form-control" id="total_harga"
                                                                name="total_harga"
                                                                value="{{ $pesanan->homestay->pemilik->bank[0]->nama_bank }}"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="total_harga">Nama Akun</label>
                                                            <input type="text" class="form-control" id="total_harga"
                                                                name="total_harga"
                                                                value="{{ $pesanan->homestay->pemilik->bank[0]->nama }}"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="total_harga">Nomor Rekening</label>
                                                            <input type="text" class="form-control" id="total_harga"
                                                                name="total_harga"
                                                                value="{{ $pesanan->homestay->pemilik->bank[0]->nomor_rekening }}"
                                                                disabled>
                                                        </div>

                                                        <h6 class="mb-3 mt-3">Bukti Pembayaran</h6>
                                                        <div class="custom-file mb-3">
                                                            <input type="file" class="custom-file-input"
                                                                id="validatedCustomFile" required name="gambar">
                                                            <label class="custom-file-label"
                                                                for="validatedCustomFile">Pilih
                                                                Gambar...</label>
                                                        </div>
                                                        {{-- <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Example select</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        @foreach ($pesanan->homestay->pemilik->bank as $item)
                                                            <option>
                                                                <div>
                                                                    <h1>{{$item->nama}}</h1>
                                                                    <h1>{{$item->nama_bank}}</h1>
                                                                </div>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                  </div> --}}
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/pesanan_user/detail/{{ $pesanan->id }}"
                                            class="btn btn-outline-success">Detail</a>
                                    </div>
                                </div>

                            </div>
                            <div class="m-3"></div>
                        </div>
                    @endforeach
                @else
                    <h5>Anda belum memiliki pesanan</h5>
                @endif

            </div>

        </div>
    </header>
@endsection
