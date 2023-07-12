<div>
    <h5 class="mb-5">Data Inventor</h5>
    <button type="button" class="btn btn-primary me-3 mb-3" wire:click="openModalAdd" ><i class="fa-solid fa-plus"></i> Tambah Inventor</button>
    <table class="table" id="pemegang-hak-cipta-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kewarganegaraan</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            {{-- @dd($inventors) --}}
            @foreach ($inventors as $inventor)
            <tr>
                <td>{{$inventor->name}}</td>
                <td>{{$inventor->Nationality->name}}</td>
                <td>{{$inventor->complete_address}}</td>
                <td>{{$inventor->email}}</td>
                <td>{{$inventor->telephone}}</td>
                <td>
                    <div wire:ignore.self class="btn-group" role="group" aria-label="PIC Details Action">
                        <button type="button" wire:click="edit('{{$inventor['id']}}')" class="btn btn-warning btn-sm me-2 mb-1"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                        {{-- <button type="button" wire:click="delete('{{$inventor['id']}}')" class="btn btn-sm btn-danger mb-1 me-2"><i class="fa-solid fa-trash-can"></i> Delete</button> --}}
                        <button type="button" onclick="deleteInventor('{{$inventor['id']}}')" class="btn btn-sm btn-danger mb-1 me-2"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    </div>
                </td>
            </tr>
            @endforeach
            @if (count($inventors) < 1)
            <tr>
                <td colspan="6" style="text-align: center;">Empty</td>
            </tr>
            @endif
        </tbody>
    </table>
    @error('inventor') <span class="text-danger">{{ $message }}</span> @enderror

    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="addInventor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Creator</h1>
                </div>
                <div class="modal-body">
                    
                    {{-- name --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Lengkap (Dengan Gelar) *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="name" class="form-control" wire:model="name" placeholder="Nama" value="{{ old('name') }}">
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- Kewarganegaraan --}}
                    <div class="col-md-4">
                        <label class="mt-2">Kewarganegaraan *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <select class="form-select" wire:model="nationality_id" id="nationality_id">
                            <option value="">- Pilih Kewarganegaraan -</option>
                            @foreach ($countries as $kewarganegaraan)
                            <option value="{{$kewarganegaraan['id']}}" @selected(old('nationality_id') == $kewarganegaraan['id'])>{{$kewarganegaraan['name']}}</option>
                            @endforeach
                        </select>
                        @error('nationality_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Negara --}}
                    <div wire:ignore.self class="col-md-4">
                        <label class="mt-2">Negara Tinggal*</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group">
                        <select class="form-select" wire:model="country_id" id="country_id" onchange="countryFuncAction()">
                            <option value="">- Pilih Negara -</option>
                            @foreach ($countries as $kewarganegaraan)
                            <option value="{{$kewarganegaraan['id']}}" @selected(old('country_id') == $kewarganegaraan['id'])>{{$kewarganegaraan['name']}}</option>
                            @endforeach
                        </select>
                        @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Provinsi --}}
                    <div wire:ignore.self class="col-md-4 ina" id="province_id_label_inventor">
                        <label class="mt-2" >Provinsi *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="province_id_input_inventor">
                        <select class="form-select" wire:model="province_id" id="province_id">
                            <option value="">- Pilih Provinsi -</option>
                            @foreach ($provinsis as $provinsi)
                            <option value="{{$provinsi['id']}}" @selected(old('province_id') == $provinsi['id'])>{{$provinsi['name']}}</option>
                            @endforeach
                        </select>
                        @error('province_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kota --}}
                    <div wire:ignore.self class="col-md-4 ina" id="district_id_label_inventor">
                        <label class="mt-2" >Kota *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="district_id_input_inventor">
                        <select class="form-select" wire:model="district_id" id="district_id">
                            <option value="">- Pilih Kota -</option>
                            @foreach ($districts as $district)
                            <option value="{{$district['id']}}" @selected(old('district_id') == $district['id'])>{{$district['name']}}</option>
                            @endforeach
                        </select>
                        @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div wire:ignore.self class="col-md-4 ina" id="subdistrict_id_label_inventor">
                        <label class="mt-2" >Kecamatan *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="subdistrict_id_input_inventor">
                        <select class="form-select" wire:model="subdistrict_id" id="subdistrict_id">
                            <option value="">- Pilih Kecamatan -</option>
                            @foreach ($subdistricts as $subdistrict)
                            <option value="{{$subdistrict['id']}}" @selected(old('subdistrict_id') == $subdistrict['id'])>{{$subdistrict['name']}}</option>
                            @endforeach
                        </select>
                        @error('subdistrict_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                            
                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat*</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <textarea wire:model="address" id="address" rows="3" placeholder="Alamat" class="form-control">{{old('address')}}</textarea>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- email --}}
                    <div class="col-md-4">
                        <label class="mt-2">Email *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="email" id="email" class="form-control" wire:model="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="no_telp" class="form-control" wire:model="no_telp" placeholder="No Telepon" value="{{ old('no_telp') }}">
                        </div>
                        @error('no_telp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModalAdd" class="btn btn-secondary">Close</button>
                    <button type="button" wire:click="saveInventor" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div wire:ignore.self class="modal fade" id="editInventor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Creator</h1>
                </div>
                <div class="modal-body">
                    
                    {{-- name --}}
                    <div class="col-md-4">
                        <label class="mt-2">Nama Lengkap (Dengan Gelar) *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="name" class="form-control" wire:model="name_edit" placeholder="Nama" value="{{ old('name') }}">
                        </div>
                        @error('name_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- Kewarganegaraan --}}
                    <div class="col-md-4">
                        <label class="mt-2">Kewarganegaraan *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <select class="form-select" wire:model="nationality_id_edit" id="nationality_id">
                            <option value="">- Pilih Kewarganegaraan -</option>
                            @foreach ($countries as $kewarganegaraan)
                            <option value="{{$kewarganegaraan['id']}}" @selected(old('nationality_id') == $kewarganegaraan['id'])>{{$kewarganegaraan['name']}}</option>
                            @endforeach
                        </select>
                        @error('nationality_id_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Negara --}}
                    <div wire:ignore.self class="col-md-4">
                        <label class="mt-2">Negara Tinggal*</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group">
                        <select class="form-select" wire:model="country_id_edit" id="country_id_edit" onchange="countryFuncAction()">
                            <option value="">- Pilih Negara -</option>
                            @foreach ($countries as $kewarganegaraan)
                            <option value="{{$kewarganegaraan['id']}}" @selected(old('country_id') == $kewarganegaraan['id'])>{{$kewarganegaraan['name']}}</option>
                            @endforeach
                        </select>
                        @error('country_id_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Provinsi --}}
                    <div wire:ignore.self class="col-md-4 ina" id="province_id_label_inventor_edit">
                        <label class="mt-2" >Provinsi *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="province_id_input_inventor_edit">
                        <select class="form-select" wire:model="province_id_edit" id="province_id">
                            <option value="">- Pilih Provinsi -</option>
                            @foreach ($provinsis as $provinsi)
                            <option value="{{$provinsi['id']}}" @selected(old('province_id') == $provinsi['id'])>{{$provinsi['name']}}</option>
                            @endforeach
                        </select>
                        @error('province_id_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kota --}}
                    <div wire:ignore.self class="col-md-4 ina" id="district_id_label_inventor_edit">
                        <label class="mt-2" >Kota *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="district_id_input_inventor_edit">
                        <select class="form-select" wire:model="district_id_edit" id="district_id">
                            <option value="">- Pilih Kota -</option>
                            @foreach ($districts_edit as $district)
                            <option value="{{$district['id']}}" @selected(old('district_id') == $district['id'])>{{$district['name']}}</option>
                            @endforeach
                        </select>
                        @error('district_id_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div wire:ignore.self class="col-md-4 ina" id="subdistrict_id_label_inventor_edit">
                        <label class="mt-2" >Kecamatan *</label >
                    </div>
                    <div wire:ignore.self class="col-md-12 form-group ina" id="subdistrict_id_input_inventor_edit">
                        <select class="form-select" wire:model="subdistrict_id_edit" id="subdistrict_id">
                            <option value="">- Pilih Kecamatan -</option>
                            @foreach ($subdistricts_edit as $subdistrict)
                            <option value="{{$subdistrict['id']}}" @selected(old('subdistrict_id') == $subdistrict['id'])>{{$subdistrict['name']}}</option>
                            @endforeach
                        </select>
                        @error('subdistrict_id_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                            
                    {{-- Alamat --}}
                    <div class="col-md-4">
                        <label class="mt-2" >Alamat*</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <textarea wire:model="address_edit" id="address" rows="3" placeholder="Alamat" class="form-control">{{old('address')}}</textarea>
                        @error('address_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- email --}}
                    <div class="col-md-4">
                        <label class="mt-2">Email *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="email" id="email" class="form-control" wire:model="email_edit" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        @error('email_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    {{-- no_telp --}}
                    <div class="col-md-4">
                        <label class="mt-2">No Telepon *</label >
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="no_telp" class="form-control" wire:model="no_telp_edit" placeholder="No Telepon" value="{{ old('no_telp') }}">
                        </div>
                        @error('no_telp_edit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModalEdit" class="btn btn-secondary">Close</button>
                    <button type="button" wire:click="editInventor('{{$idsEdit}}')" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>



