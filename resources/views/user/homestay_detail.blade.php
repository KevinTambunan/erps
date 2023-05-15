@extends('user.layouts.user')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
    <header class="py-2">
        <div class="container px-5 pb-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-2">
                        <div class="card-body">
                            <p class="card-title fw-bold">{{ $homestay->nama }}</h6>
                            <p class="card-text"
                                style="line-height: 1.2; height: calc(1.2em * 2); overflow: hidden; margin-bottom:0px;">
                                {{ $homestay->alamat }}</p>
                            <img src="{{ asset('assets/images/' . $homestay->gambar) }}" style="width: 750px"
                                class="rounded" alt="" srcset="">
                            <div class="m-3"></div>
                            <div class="row">
                                @foreach ($homestay->foto as $item)
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
                            <h6>Detail Harga</h6>
                            <p class="card-text text-danger">Rp. {{ $homestay->harga }} / Malam</p>
                            <a type="button" class="btn btn-block btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Pesan Sekarang</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pesan {{ $homestay->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/homestay_user/pesan/{{ $homestay->id }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="tanggal_mulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggal_mulai"
                                                name="tanggal_mulai">
                                        </div>
                                        <div class="m-3"></div>
                                        <div class="form-group">
                                            <label for="tanggal_berakhir">Tanggal Berakhir</label>
                                            <input type="date" class="form-control" id="tanggal_berakhir"
                                                name="tanggal_berakhir">
                                        </div>
                                        <div class="m-3"></div>
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3"></div>
            <div>
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
