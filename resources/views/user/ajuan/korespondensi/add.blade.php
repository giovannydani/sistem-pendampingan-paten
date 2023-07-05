<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Koresponden</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    {{-- name_applicant --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Koresponden</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="name_applicant" class="form-control" placeholder="Nama" value="{{ old('name_applicant') }}" disabled>
                        </div>
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="no_telp_applicant" class="form-control" placeholder="No Telepon" value="{{ old('no_telp_applicant') }}" disabled>
                        </div>
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Badan Hukum</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="legal_entity_name" class="form-control" placeholder="Nama Badan Hukum" value="{{ old('legal_entity_name') }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- email --}}
                    <div class="col-md-4">
                        <label class="mt-2">Email</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="email" id="email_applicant" class="form-control" placeholder="Email" value="{{ old('email_applicant') }}" disabled>
                        </div>
                        @error('email_applicant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat Surat Menyurat*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <textarea id="address_applicant" rows="3" placeholder="Alamat" class="form-control" disabled>{{old('address_applicant')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>