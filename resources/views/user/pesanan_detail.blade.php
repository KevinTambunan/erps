@extends('user.layouts.user')

<link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
    <header class="py-2">
        <div class="container px-5 pb-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-2">
                        <div class="card-body">
                            <p class="card-title fw-bold">{{ $pesanan->homestay->nama }}</h6>
                            <p class="card-text"
                                style="line-height: 1.2; height: calc(1.2em * 2); overflow: hidden; margin-bottom:0px;">
                                {{ $pesanan->homestay->alamat }}</p>
                            <img src="{{ asset('assets/images/' . $pesanan->homestay->gambar) }}" style="width: 750px"
                                class="rounded" alt="" srcset="">
                            <div class="m-3"></div>
                            <div class="row">
                                @foreach ($pesanan->homestay->foto as $item)
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/images/' . $item['nama']) }}" style="max-width: 165px"
                                            class="rounded border" alt="" srcset="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detail Pesanan</h6>
                            @if ($pesanan->status == 'dikonfirmasi')
                                <p>Pembayaran terkonfirmasi, anda dapat menggunakan homestay pada rentang waktu
                                    {{ $pesanan->tanggal_mulai }} hingga {{ $pesanan->tanggal_berakhir }} </p>
                                <a type="button" class="btn btn-block btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Beri ulasan kepada homestay</a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ulasan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/pesanan/ulasan">
                                                    @csrf
                                                    <input type="hidden" name="pemesan_id" value="{{$pesanan->pemesan->id}}">
                                                    <input type="hidden" name="homestay_id" value="{{$pesanan->homestay->id}}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Ulasan</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="ulasan"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Rate</label>
                                                        <select class="form-control" id="exampleFormControlSelect1" name="rate">
                                                          <option>1</option>
                                                          <option>2</option>
                                                          <option>3</option>
                                                          <option>4</option>
                                                          <option>5</option>
                                                        </select>
                                                      </div>

                                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($pesanan->status == 'menunggu pembayaran')
                                <form method="POST"
                                    action="/pembayaran/create/{{ $pesanan->pemesan_id }}/{{ $pesanan->homestay->pemilik->id }}/{{ $pesanan->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="nama">Nama Homestay</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $pesanan->homestay->nama }}" disabled>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                            value="{{ $pesanan->tanggal_mulai }}" disabled>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="tanggal_berakhir">Tanggal Berakhir</label>
                                        <input type="date" class="form-control" id="tanggal_berakhir"
                                            name="tanggal_berakhir" value="{{ $pesanan->tanggal_berakhir }}" disabled>
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
                                        <input type="number" class="form-control" id="total_harga" name="total_harga"
                                            value="{{ $pesanan->total_harga }}" disabled>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="total_harga">Bank Tujuan</label>
                                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                                            value="{{ $pesanan->homestay->pemilik->bank[0]->nama_bank }}" disabled>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="total_harga">Nama Akun</label>
                                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                                            value="{{ $pesanan->homestay->pemilik->bank[0]->nama }}" disabled>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="total_harga">Nomor Rekening</label>
                                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                                            value="{{ $pesanan->homestay->pemilik->bank[0]->nomor_rekening }}" disabled>
                                    </div>

                                    <h6 class="mb-3 mt-3">Bukti Pembayaran</h6>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" required
                                            name="gambar">
                                        <label class="custom-file-label" for="validatedCustomFile">Pilih
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
                                    <button type="submit" class="btn btn-success btn-block">Bayar Sekarang</button>
                                </form>
                            @elseif($pesanan->status == 'diproses')
                                <p>Pembayaran anda sedang diproses, tunggu hingga pemilik homestay konfirmasi pembayaran
                                    anda</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3"></div>
            <div class="row">
                <h5 class="">Ulasan</h5>
                @foreach ($ulasans as $ulasan)
                    <div class="card col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ulasan->pemesan->nama }}</h5>
                            <p class="card-text">{{ $ulasan->ulasan }}</p>
                            @for ($i = 0; $i < $ulasan->rate; $i++)
                                <i class="fa-solid fa-star" style="color: #e0bd10;"></i>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </header>
@endsection
