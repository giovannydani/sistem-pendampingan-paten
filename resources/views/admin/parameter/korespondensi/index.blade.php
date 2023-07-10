@extends('template.main')

@section('page-title', 'Tambah Ajuan')

@section('content')
<div class="page-heading">
  <h3>Parameter Korespondensi</h3>
</div>
<div class="page-content">
    <section class="section">

        <form action="{{ route('admin.parameter.korespondensi.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- detail --}}
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="mb-5">Detail</h5> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
            
                                {{-- name_correspondent --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Nama Koresponden*</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" id="name_correspondent" class="form-control" name="name_correspondent" placeholder="Nama" value="{{ old('name_correspondent', $correspondence->name) }}">
                                    </div>
                                    @error('name_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
            
                                {{-- email --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Email Koresponden*</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <div class="input-group mb-3">
                                        <input type="email" id="email_correspondent" class="form-control" name="email_correspondent" placeholder="Email" value="{{ old('email_correspondent', $correspondence->email) }}">
                                    </div>
                                    @error('email_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- no_telp --}}
                                <div class="col-md-4">
                                    <label class="mt-2">No Telepon *</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" id="no_telp_correspondent" class="form-control" name="no_telp_correspondent" placeholder="No Telepon" value="{{ old('no_telp_correspondent', $correspondence->telephone) }}">
                                    </div>
                                    @error('no_telp_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <select class="form-select" name="country_id_correspondent" id="country_id_correspondent" onchange="countryFuncAction()">
                                        <option value="">- Pilih Negara -</option>
                                        @foreach ($kewarganegaraans as $kewarganegaraan)
                                        <option value="{{$kewarganegaraan->id}}" @selected(old('country_id_correspondent', $correspondence->country_id) == $kewarganegaraan->id)>{{$kewarganegaraan->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                {{-- Alamat --}}
                                <div class="col-md-4">
                                    <label class="mt-2" >Alamat Tempat Tinggal*</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea name="address_correspondent" id="address_correspondent" rows="3" placeholder="Alamat" class="form-control">{{old('address_correspondent', $correspondence->address)}}</textarea>
                                    @error('address_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
            
                                {{-- Provinsi --}}
                                <div class="col-md-4" id="province_id_correspondent_label_correspondent">
                                    <label class="mt-2" >Provinsi Tempat Tinggal*</label >
                                </div>
                                <div class="col-md-8 form-group" id="province_id_correspondent_input_correspondent">
                                    <select class="form-select" name="province_id_correspondent" id="province_id_correspondent" onchange="provinceFuncAction()">
                                        <option value="">- Pilih Provinsi -</option>
                                        @foreach ($provinsis as $provinsi)
                                        <option value="{{$provinsi->id}}" @selected(old('province_id_correspondent', $correspondence->province_id) == $provinsi->id)>{{$provinsi->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
            
                                {{-- Kota --}}
                                <div class="col-md-4" id="district_id_label_correspondent">
                                    <label class="mt-2" >Kota Tempat Tinggal*</label >
                                </div>
                                <div class="col-md-8 form-group" id="district_id_input_correspondent">
                                    <select class="form-select" name="district_id_correspondent" id="district_id_correspondent" onchange="districtFuncAction()">
                                        <option value="">- Pilih Kota -</option>
                                    </select>
                                    @error('district_id_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
            
                                {{-- Kecamatan --}}
                                <div class="col-md-4" id="subdistrict_id_label_correspondent">
                                    <label class="mt-2" >Kecamatan Tempat Tinggal*</label >
                                </div>
                                <div class="col-md-8 form-group" id="subdistrict_id_input_correspondent">
                                    <select class="form-select" name="subdistrict_id_correspondent" id="subdistrict_id_correspondent">
                                        <option value="">- Pilih Kecamatan -</option>
                                    </select>
                                    @error('subdistrict_id_correspondent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary me-3 mb-3"><i class="fa-solid fa-plus"></i> Submit</button>
                    <button type="button" class="btn btn-danger me-3 mb-3"><i class="fa-solid fa-xmark"></i> Cancel</button>
                </div>
            </div>
        </form>
        

    </section>
</div>
@endsection

@section('js')
<script>
    var _token = "{{ csrf_token() }}";
    $(document).ready(function () {
        console.log('app');
    });

    $(document).ready(function () {
        $('#province_id_correspondent_input_correspondent').hide();
        $('#district_id_input_correspondent').hide();
        $('#subdistrict_id_input_correspondent').hide();
        $('#province_id_correspondent_label_correspondent').hide();
        $('#district_id_label_correspondent').hide();
        $('#subdistrict_id_label_correspondent').hide();

        countryFuncAction();
    })

    function countryFuncAction() {
        if ($('#country_id_correspondent').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $('#province_id_correspondent_input_correspondent').hide();
            $('#district_id_input_correspondent').hide();
            $('#subdistrict_id_input_correspondent').hide();
            $('#province_id_correspondent_label_correspondent').hide();
            $('#district_id_label_correspondent').hide();
            $('#subdistrict_id_label_correspondent').hide();
        }else{
            $('#province_id_correspondent_input_correspondent').show();
            $('#district_id_input_correspondent').show();
            $('#subdistrict_id_input_correspondent').show();
            $('#province_id_correspondent_label_correspondent').show();
            $('#district_id_label_correspondent').show();
            $('#subdistrict_id_label_correspondent').show();

            provinceFuncAction();
            districtFuncAction("old");
        }
    }
    
    var selected_district = "{{ old('district_id_correspondent', $correspondence->district_id) }}";
    function provinceFuncAction() {
        var province = $('#province_id_correspondent').val();
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
                    $("#district_id_correspondent").html(data);
                }
            });
        }else{
            $("#district_id_correspondent").html("<option value=\"\">- Pilih Kota -</option>");
        }
    }
    
    var selected_subdistrict = "{{ old('subdistrict_id_correspondent', $correspondence->subdistrict_id) }}";
    function districtFuncAction(status = "") {
        var district = $('#district_id_correspondent').val();
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
                    $("#subdistrict_id_correspondent").html(data);
                }
            });
        }else{
            $("#subdistrict_id_correspondent").html("<option value=\"\">- Pilih Kecamatan -</option>");
        }
    }
</script>
@endsection