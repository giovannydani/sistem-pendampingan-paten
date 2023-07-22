<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Pemohon</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    {{-- name_applicant --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Pemohon</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{$patentDetail->PatentApplicant->name}}</p>
                        </div>
                    </div>

                    {{-- email --}}
                    <div class="col-md-4">
                        <label class="mt-2">Email Pemohon</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{$patentDetail->PatentApplicant->email}}</p>
                        </div>
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{$patentDetail->PatentApplicant->telephone}}</p>
                        </div>
                    </div>

                    {{-- Kewarganegaraan --}}
                    <div class="col-md-4">
                        <label class="mt-2">Kewarganegaraan</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{$patentDetail->PatentApplicant->Nationality->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- Negara --}}
                    <div class="col-md-4">
                        <label class="mt-2">Negara Tempat Tinggal</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{$patentDetail->PatentApplicant->Country->name}}</p>
                    </div>
                    
                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat Tempat Tinggal</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{$patentDetail->PatentApplicant->address}}</p>
                    </div>

                    @if ($patentDetail->PatentApplicant->Province)
                    {{-- Provinsi --}}
                    <div class="col-md-4" id="province_id_applicant_label_applicant">
                        <label class="mt-2" >Provinsi Tempat Tinggal</label >
                    </div>
                    <div class="col-md-8 form-group" id="province_id_applicant_input_applicant">
                        <p class="form-control">{{$patentDetail->PatentApplicant->Province->name}}</p>
                    </div>
                    @endif

                    @if ($patentDetail->PatentApplicant->District)
                    {{-- Kota --}}
                    <div class="col-md-4" id="district_id_label_applicant">
                        <label class="mt-2" >Kota Tempat Tinggal</label >
                    </div>
                    <div class="col-md-8 form-group" id="district_id_input_applicant">
                        <p class="form-control">{{$patentDetail->PatentApplicant->District->name}}</p>
                    </div>
                    @endif

                    @if ($patentDetail->PatentApplicant->Subdistrict)
                    {{-- Kecamatan --}}
                    <div class="col-md-4" id="subdistrict_id_label_applicant">
                        <label class="mt-2" >Kecamatan Tempat Tinggal</label >
                    </div>
                    <div class="col-md-8 form-group" id="subdistrict_id_input_applicant">
                        <p class="form-control">{{$patentDetail->PatentApplicant->Subdistrict->name}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>