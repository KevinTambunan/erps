@extends('user.layout.layout')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Erp Recomendation</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="erp-recomendation/store" method="post">
                            @csrf
                            {{-- modul --}}
                            <div class="form-group">
                                @foreach ($moduls as $modul)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="{{"modul".$modul->name}}" value="{{$modul->id}}" id="{{$modul->name}}">
                                        <label class="form-check-label" for="{{$modul->name}}">
                                            {{$modul->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
