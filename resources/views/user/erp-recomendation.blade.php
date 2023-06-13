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
                            <div class="form-group" id="modul">
                                1. Apa saja Modul yang anda butuhkan didalam penerapan ERP yang nantinya akan direkomendasikan untuk mencapai tujuan  ?
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($moduls as $modul)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="{{ 'modul' . $modul->name }}"
                                            value="{{ $modul->id }}" id="{{ 'modul' . $modul->name }}" data-question="1">
                                        <label class="form-check-label" for="{{ 'modul' . $modul->name }}">
                                            {{ $modul->name }}
                                        </label>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                                <p class="text-danger" id="errorModul"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextModul()">Next</button>
                                    <button type="button" class="btn btn-link" onclick="clearModul()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                            </div>

                            {{-- fungsionalitas --}}
                            <div class="form-group" id="fungsionalitas" style="display: none">
                                2. Apakah Fungsionalitas utaman yang harus dimiliki ERP_Recommendation yang Anda harapkan?
                                @foreach ($fungsionalitas as $fungsionalitas)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="{{ 'fungsionalitas' . $fungsionalitas->name }}"
                                            value="{{ $fungsionalitas->id }}" id="{{ $fungsionalitas->name }}"
                                            data-question="2">
                                        <label class="form-check-label" for="{{ $fungsionalitas->name }}">
                                            {{ $fungsionalitas->name }}
                                        </label>
                                    </div>
                                @endforeach

                                <p class="text-danger" id="errorFungsionalitas"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="backFungsionalitas()">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextFungsionalitas()">Next</button>
                                    <button type="button" class="btn btn-link" onclick="clearFungsionalitas()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                            </div>

                            {{-- function area --}}
                            <div class="form-group" id="function_area" style="display: none">
                                3. Apa saja area fungsional spesifik yang harus ada untuk memenuhi kebutuhan Anda dalam penerapan ERP?
                                @foreach ($function_area as $function_are)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="{{ 'function area' . $function_are->name }}"
                                            value="{{ $function_are->id }}" id="{{ $function_are->name }}"
                                            data-question="3">
                                        <label class="form-check-label" for="{{ $function_are->name }}">
                                            {{ $function_are->name }}
                                        </label>
                                    </div>
                                @endforeach

                                <p class="text-danger" id="errorFunctionArea"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="backFunctionArea()">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextFunctionArea()">Next</button>
                                    <button type="button" class="btn btn-link" onclick="clearFunctionArea()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                            </div>

                            {{-- user need --}}
                            <div class="form-group" id="user_need" style="display: none">
                                4. Berapakah perkiraan jumlah pengguna yang nantinya akan menggunakan ERP yang direkomendasikan?
                                @foreach ($user_needs as $user_need)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_need"
                                            id="{{ $user_need->name }}" value="{{ $user_need->id }}">
                                        <label class="form-check-label"
                                            for="{{ $user_need->name }}">{{ $user_need->name }}</label>
                                    </div>
                                @endforeach

                                <p class="text-danger" id="errorUserNeed"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="backUserNeed()">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextUserNeed()">Next</button>
                                    <button type="button" class="btn btn-link" onclick="clearUserNeed()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                            </div>

                            {{-- type --}}
                            <div class="form-group" id="type" style="display: none">
                                5. Apa profil atau peferensi Anda dalam menggunakan sistem Erp?
                                @foreach ($types as $type)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type"
                                            id="{{ $type->name }}" value="{{ $type->id }}">
                                        <label class="form-check-label"
                                            for="{{ $type->name }}">{{ $type->name }}</label>
                                    </div>
                                @endforeach

                                <p class="text-danger" id="errorType"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="backType()">Back</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="nextType()">Next</button>
                                    <button type="button" class="btn btn-link" onclick="clearType()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                            </div>

                            {{-- other requierement --}}
                            <div class="form-group" id="other_requirement" style="display: none">
                                Apa Other Requirement anda?
                                @foreach ($other_requirements as $other_requirement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="other_requirement"
                                            id="{{ $other_requirement->name }}" value="{{ $other_requirement->id }}">
                                        <label class="form-check-label"
                                            for="{{ $other_requirement->name }}">{{ $other_requirement->name }}</label>
                                    </div>
                                @endforeach

                                <p class="text-danger" id="errorOtherRequirement"></p>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="backOtherRequirement()">Back</button>
                                    <button type="button" class="btn btn-link" onclick="clearOtherRequirement()"><span
                                            class="text-danger">Clear
                                            Answer</span></button>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var modul = document.getElementById("modul");
        var fungsionalitas = document.getElementById("fungsionalitas");
        var function_area = document.getElementById("function_area");
        var user_need = document.getElementById("user_need");
        var type = document.getElementById("type");
        var other_requirement = document.getElementById("other_requirement");

        // cek error modul
        const pertanyaan1Checked = document.querySelectorAll('input[data-question="1"]');
        var errorModul = document.getElementById("errorModul");
        var checkModulError = true;

        // cek error fungsionalitas
        const pertanyaan2Checked = document.querySelectorAll('input[data-question="2"]');
        var errorFungsionalitas = document.getElementById("errorFungsionalitas");
        var checkFungsionalitasError = true;

        // cek error function area
        const pertanyaan3Checked = document.querySelectorAll('input[data-question="3"]');
        var errorFunctionArea = document.getElementById("errorFunctionArea");
        var checkFunctionAreaError = true;

        // user need check error
        var errorUserNeed = document.getElementById("errorUserNeed");
        var radioButtonsUserNeed = document.querySelectorAll('input[name="user_need"]');
        var selectedOptionUserNeed = null;
        var selectedValueUserNeed = null;

        for (var i = 0; i < radioButtonsUserNeed.length; i++) {
            radioButtonsUserNeed[i].addEventListener('change', function() {
                selectedOptionUserNeed = this;
                selectedValueUserNeed = selectedOptionUserNeed.value;
            });
        }

        function clearUserNeed() {
            for (var i = 0; i < radioButtonsUserNeed.length; i++) {
                radioButtonsUserNeed[i].checked = false;
            }
            selectedValueUserNeed = null;
        }

        // type check error
        var errorType = document.getElementById("errorType");
        var radioButtonsType = document.querySelectorAll('input[name="type"]');
        var selectedOptionType = null;
        var selectedValueType = null;

        for (var i = 0; i < radioButtonsType.length; i++) {
            radioButtonsType[i].addEventListener('change', function() {
                selectedOptionType = this;
                selectedValueType = selectedOptionType.value;
            });
        }

        function clearType() {
            for (var i = 0; i < radioButtonsType.length; i++) {
                radioButtonsType[i].checked = false;
            }
            selectedValueType = null;
        }

        function clearModul() {
            for (var i = 0; i < pertanyaan1Checked.length; i++) {
                pertanyaan1Checked[i].checked = false;
            }
            checkModulError = true;
        }

        function clearFungsionalitas() {
            for (var i = 0; i < pertanyaan2Checked.length; i++) {
                pertanyaan2Checked[i].checked = false;
            }
            checkFungsionalitasError = true;
        }

        function clearFunctionArea() {
            for (var i = 0; i < pertanyaan3Checked.length; i++) {
                pertanyaan3Checked[i].checked = false;
            }
            checkFunctionAreaError = true;
        }

        function nextModul() {
            for (var i = 0; i < pertanyaan1Checked.length; i++) {
                if (pertanyaan1Checked[i].checked == true) {
                    checkModulError = false;
                }
            }
            if (checkModulError) {
                errorModul.textContent = 'The answer has not been chosen, choose an answer';
            } else {
                errorModul.textContent = '';
                modul.style.display = 'none';
                fungsionalitas.style.display = '';
            }
        }

        function backFungsionalitas() {
            modul.style.display = '';
            fungsionalitas.style.display = 'none';
        }

        function nextFungsionalitas() {
            for (var i = 0; i < pertanyaan2Checked.length; i++) {
                if (pertanyaan2Checked[i].checked == true) {
                    checkFungsionalitasError = false;
                }
            }
            if (checkFungsionalitasError) {
                errorFungsionalitas.textContent = 'The answer has not been chosen, choose an answer';
            } else {
                errorFungsionalitas.textContent = '';
                fungsionalitas.style.display = 'none';
                function_area.style.display = '';
            }
        }

        function backFunctionArea() {
            fungsionalitas.style.display = '';
            function_area.style.display = 'none';
        }

        function nextFunctionArea() {
            for (var i = 0; i < pertanyaan3Checked.length; i++) {
                if (pertanyaan3Checked[i].checked == true) {
                    checkFunctionAreaError = false;
                }
            }
            if (checkFunctionAreaError) {
                errorFunctionArea.textContent = 'The answer has not been chosen, choose an answer';
            } else {
                errorFunctionArea.textContent = '';
                user_need.style.display = '';
                function_area.style.display = 'none';
            }
        }

        function backUserNeed() {
            user_need.style.display = 'none';
            function_area.style.display = '';
        }

        function nextUserNeed() {
            if (!selectedValueUserNeed) {
                errorUserNeed.textContent = 'The answer has not been chosen, choose an answer';
            } else {
                errorUserNeed.textContent = '';
                user_need.style.display = 'none';
                type.style.display = '';
            }

        }

        function backType() {
            user_need.style.display = '';
            type.style.display = 'none';
        }

        function nextType() {
            if (!selectedValueType) {
                errorType.textContent = 'The answer has not been chosen, choose an answer';
            } else {
                errorType.textContent = '';
                type.style.display = 'none';
                other_requirement.style.display = '';
            }

        }

        function backOtherRequirement() {
            type.style.display = '';
            other_requirement.style.display = 'none';
        }
        
    </script>
@endsection
