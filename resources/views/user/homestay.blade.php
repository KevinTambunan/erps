@extends('user.layouts.user')

@section('content')
    <header class="py-2">
        <div class="container px-5 pb-5">
            <div class="row">
                <h5 class="mt-3 mb-3">Homestay yang tersedia</h5>
                @foreach ($homestays as $homestay)
                    <div class="card col-md-3 border-0">
                        <img src="{{ asset('assets/images/' . $homestay->gambar) }}" class="card-img-top" alt="..."
                            style="height:250px; object-fit: cover;">
                        <div class="m-1">
                            <p class="card-title fw-bold">{{ $homestay->nama }}</h6>
                            <p class="card-text"
                                style="line-height: 1.2; height: calc(1.2em * 2); overflow: hidden; margin-bottom:0px;">
                                {{ $homestay->alamat }}</p>
                            <p class="card-text text-danger" style="margin-bottom:0px;">Rp. {{ $homestay->harga }} / Malam
                            </p>
                            <p class="card-text">{{ $homestay->pemilik['no_telephone'] }}</p>
                            <div class="row">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-block btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{$homestay->id}}">Pesan Sekarang</a>
                                    <div class="modal fade" id="exampleModal{{$homestay->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pesan
                                                        {{ $homestay->nama }}</h5>
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
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="/homestay_user/detail/{{ $homestay->id }}"
                                        class="btn btn-outline-success">Detail</a>
                                </div>
                            </div>

                        </div>
                        <div class="m-3"></div>
                    </div>
                @endforeach
            </div>

        </div>
    </header>
@endsection
