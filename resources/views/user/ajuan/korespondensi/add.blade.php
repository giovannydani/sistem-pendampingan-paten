<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Koresponden</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    {{-- name_correspondent --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Koresponden</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{ $patentDetail->PatentCorrespondent->name }}</p>
                            {{-- <input type="text" id="name_correspondent" class="form-control" placeholder="Nama" value="{{ $patentDetail->PatentCorrespondent->name }}" disabled> --}}
                        </div>
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{ $patentDetail->PatentCorrespondent->telephone }}</p>
                            {{-- <input type="text" id="no_telp_correspondent" class="form-control" placeholder="No Telepon" value="{{ old('no_telp_correspondent') }}" disabled> --}}
                        </div>
                    </div>
                    
                    @if ($patentDetail->PatentCorrespondent->legal_entity_name)
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Badan Hukum</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <p class="form-control">{{ $patentDetail->PatentCorrespondent->legal_entity_name }}</p>
                            {{-- <input type="text" id="legal_entity_name" class="form-control" placeholder="Nama Badan Hukum" value="{{ old('legal_entity_name') }}" disabled> --}}
                        </div>
                    </div>
                    @endif
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
                            <p class="form-control">{{ $patentDetail->PatentCorrespondent->email }}</p>
                            {{-- <input type="email" id="email_correspondent" class="form-control" placeholder="Email" value="{{ old('email_correspondent') }}" disabled> --}}
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat Surat Menyurat</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{ $patentDetail->PatentCorrespondent->complete_address }}</p>
                        {{-- <textarea id="address_correspondent" rows="3" placeholder="Alamat" class="form-control" disabled>{{old('address_correspondent')}}</textarea> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>