<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Pemohon</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    {{-- name_applicant --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Pemohon*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="name_applicant" class="form-control" name="name_applicant" placeholder="Nama" value="{{ old('name_applicant') }}">
                        </div>
                        @error('name_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- email --}}
                    <div class="col-md-4">
                        <label class="mt-2">Email Pemohon*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="email" id="email_applicant" class="form-control" name="email_applicant" placeholder="Email" value="{{ old('email_applicant') }}">
                        </div>
                        @error('email_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon *</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="no_telp_applicant" class="form-control" name="no_telp_applicant" placeholder="No Telepon" value="{{ old('no_telp_applicant') }}">
                        </div>
                        @error('no_telp_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kewarganegaraan --}}
                    <div class="col-md-4">
                        <label class="mt-2">Kewarganegaraan *</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <select class="form-select" name="nationality_id_applicant" id="nationality_id_applicant">
                            <option value="">- Pilih Kewarganegaraan -</option>
                            @foreach ($kewarganegaraans as $kewarganegaraan)
                            <option value="{{$kewarganegaraan->id}}" @selected(old('nationality_id_applicant') == $kewarganegaraan->id)>{{$kewarganegaraan->name}}</option>
                            @endforeach
                        </select>
                        @error('nationality_id_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- Negara --}}
                    <div class="col-md-4">
                        <label class="mt-2">Negara Tempat Tinggal*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <select class="form-select" wire:model="country_id_applicant" id="country_id_applicant" onchange="countryFuncAction()">
                            <option value="">- Pilih Negara -</option>
                            @foreach ($kewarganegaraans as $kewarganegaraan)
                            <option value="{{$kewarganegaraan->id}}" @selected(old('country_id_applicant') == $kewarganegaraan->id)>{{$kewarganegaraan->name}}</option>
                            @endforeach
                        </select>
                        @error('country_id_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat Tempat Tinggal*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <textarea name="address_applicant" id="address_applicant" rows="3" placeholder="Alamat" class="form-control">{{old('address_applicant')}}</textarea>
                        @error('address_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Provinsi --}}
                    <div class="col-md-4" id="province_id_applicant_label_applicant">
                        <label class="mt-2" >Provinsi Tempat Tinggal*</label >
                    </div>
                    <div class="col-md-8 form-group" id="province_id_applicant_input_applicant">
                        <select class="form-select" name="province_id_applicant" id="province_id_applicant" onchange="provinceFuncAction()">
                            <option value="">- Pilih Provinsi -</option>
                            @foreach ($provinsis as $provinsi)
                            <option value="{{$provinsi->id}}" @selected(old('province_id_applicant') == $provinsi->id)>{{$provinsi->name}}</option>
                            @endforeach
                        </select>
                        @error('province_id_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kota --}}
                    <div class="col-md-4" id="district_id_label_applicant">
                        <label class="mt-2" >Kota Tempat Tinggal*</label >
                    </div>
                    <div class="col-md-8 form-group" id="district_id_input_applicant">
                        <select class="form-select" name="district_id_applicant" id="district_id_applicant" onchange="districtFuncAction()">
                            <option value="">- Pilih Kota -</option>
                        </select>
                        @error('district_id_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div class="col-md-4" id="subdistrict_id_label_applicant">
                        <label class="mt-2" >Kecamatan Tempat Tinggal*</label >
                    </div>
                    <div class="col-md-8 form-group" id="subdistrict_id_input_applicant">
                        <select class="form-select" name="subdistrict_id_applicant" id="subdistrict_id_applicant">
                            <option value="">- Pilih Kecamatan -</option>
                        </select>
                        @error('subdistrict_id_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        console.log('app');
    });

    $(document).ready(function () {
        $('#province_id_applicant_input_applicant').hide();
        $('#district_id_input_applicant').hide();
        $('#subdistrict_id_input_applicant').hide();
        $('#province_id_applicant_label_applicant').hide();
        $('#district_id_label_applicant').hide();
        $('#subdistrict_id_label_applicant').hide();

        countryFuncAction();
    })

    function countryFuncAction() {
        if ($('#country_id_applicant').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $('#province_id_applicant_input_applicant').hide();
            $('#district_id_input_applicant').hide();
            $('#subdistrict_id_input_applicant').hide();
            $('#province_id_applicant_label_applicant').hide();
            $('#district_id_label_applicant').hide();
            $('#subdistrict_id_label_applicant').hide();
        }else{
            $('#province_id_applicant_input_applicant').show();
            $('#district_id_input_applicant').show();
            $('#subdistrict_id_input_applicant').show();
            $('#province_id_applicant_label_applicant').show();
            $('#district_id_label_applicant').show();
            $('#subdistrict_id_label_applicant').show();

            provinceFuncAction();
            districtFuncAction("old");
        }
    }
    
    var selected_district = "{{ old('district_id_applicant') }}";
    function provinceFuncAction() {
        var province = $('#province_id_applicant').val();
        if (province != "") {
            var url = "{{ url('/generate/district/') }}"+"/"+province;
            $.ajax({
                url: url,
                type:'POST',
                data: {
                    _token:_token,
                    selected_district:selected_district,
                },
                success: function(data) {
                    $("#district_id_applicant").html(data);
                }
            });
        }else{
            $("#district_id_applicant").html("<option value=\"\">- Pilih Kota -</option>");
        }
    }
    
    var selected_subdistrict = "{{ old('subdistrict_id_applicant') }}";
    function districtFuncAction(status = "") {
        var district = $('#district_id_applicant').val();
        if (status == 'old' && selected_district !="") {
            var district = selected_district;
        }
        if (district != "") {
            var url = "{{ url('/generate/subdistrict/') }}"+"/"+district;
            $.ajax({
                url: url,
                type:'POST',
                data: {
                    _token:_token,
                    selected_subdistrict:selected_subdistrict,
                },
                success: function(data) {
                    $("#subdistrict_id_applicant").html(data);
                }
            });
        }else{
            $("#subdistrict_id_applicant").html("<option value=\"\">- Pilih Kecamatan -</option>");
        }
    }
</script>
@endpush