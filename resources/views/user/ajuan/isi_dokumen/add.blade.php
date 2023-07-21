<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Isi Dokumen</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-4">
                        <label class="mt-2">Judul Invensi (Indonesia)*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="invention_title_id" class="form-control" name="invention_title_id" placeholder="Judul Invensi" value="{{ old('invention_title_id') }}">
                        </div>
                        @error('invention_title_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- Kriteria Pemohon --}}
                    <div class="col-md-4">
                        <label class="mt-2">Judul Invensi (Inggris)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="invention_title_en" class="form-control" name="invention_title_en" placeholder="Judul Invensi" value="{{ old('invention_title_en') }}">
                        </div>
                        @error('invention_title_en') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <div class="col-md-4">
                    <label class="mt-2">Klaim *</label >
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addClaimForm()"><i class="fa-solid fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <div class="row mt-5" id="container_form_claim">
            @if (old('claim_add'))
                @for ($i = 0; $i < count(old('claim_add')); $i++)
                    {{-- <div class="col-md-2 claim" id="claim_label_{{$i}}" data-no={{$i+1}}>
                        <label class="mt-2">Claim {{$i+1}}*</label >
                    </div> --}}
                    <div class="col-md-10 form-group" id="claim_input_{{$i}}">
                        <div class="input-group mb-3">
                            <textarea name="claim_add[]" id="claim_add" class="claim_add" cols="200" rows="30">{{old('claim_add.'.$i)}}</textarea>
                        </div>
                        
                        @error('claim_add.'.$i) <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2" id="claim_delete_button_{{$i}}">
                        <button type="button" class="claim btn btn-sm btn-danger" data-no={{$i+1}} onclick="deleteClaimForm({{$i}})"><i class="fa-solid fa-trash"></i> Hapus</button>
                    </div>
                @endfor
            @else
                @for ($i = 0; $i < 4; $i++)
                    {{-- <div class="col-md-2 claim" id="claim_label_{{$i}}" data-no={{$i+1}}>
                        <label class="mt-2">Claim {{$i+1}}*</label >
                    </div> --}}
                    <div class="col-md-10 form-group" id="claim_input_{{$i}}">
                        <div class="input-group mb-3">
                            <textarea name="claim_add[]" id="claim_add" class="claim_add" cols="200" rows="30"></textarea>
                        </div>
                        
                        @error('claim_add.'.$i) <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2" id="claim_delete_button_{{$i}}">
                        <button type="button" class="claim btn btn-sm btn-danger" data-no={{$i+1}} onclick="deleteClaimForm({{$i}})"><i class="fa-solid fa-trash"></i> Hapus</button>
                    </div>
                @endfor
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-4">
                        <label class="mt-2">Abstrak (Indonesia)*</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <textarea name="invention_abstract_id" id="invention_abstract_id" cols="30" rows="10" class="form-control">{{old('invention_abstract_id')}}</textarea>
                        </div>
                        @error('invention_abstract_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- Kriteria Pemohon --}}
                    <div class="col-md-4">
                        <label class="mt-2">Abstrak (Inggris)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <textarea name="invention_abstract_en" id="invention_abstract_en" cols="30" rows="10" class="form-control">{{old('invention_abstract_en')}}</textarea>
                            {{-- <input type="text" id="invention_abstract_en" class="form-control" name="invention_abstract_en" placeholder="Abstrak" value="{{ old('invention_abstract_en') }}"> --}}
                        </div>
                        @error('invention_abstract_en') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('openModalAddClaim', event => {
        $('#addClaim').modal('show');
    })

    window.addEventListener('closeModalAddClaim', event => {
        $('#addClaim').modal('hide');
    })
</script>
<script>
    $(document).ready(function() {
        $('.claim_add').summernote({
            width: 2000,
            height: 250,
        });
    });

    function addClaimForm() {
        if (countClaim() < 10) {
            var _array = [];
            
            $('.claim').each(function(key, value) {
                _array.push(parseInt($(this).data('no')));
            });
            
            if (_array.length == 0) {
                var max = 0;
            }else{
                var max = Math.max.apply(Math, _array);
            }
            
            var newIndex = max;
            var newNumber = newIndex+1;
            
            $('#container_form_claim').append('<div class="col-md-10 form-group" id="claim_input_'+newIndex+'"><div class="input-group mb-3"><textarea name="claim_add[]" id="claim_add" class="claim_add" cols="200" rows="30"></textarea></div>@error("claim_add.'+newIndex+'") <span class="text-danger">{{ $message }}</span> @enderror</div><div class="col-md-2" id="claim_delete_button_'+newIndex+'"><button type="button" class="claim btn btn-sm btn-danger" data-no='+newNumber+' onclick="deleteClaimForm('+newIndex+')"><i class="fa-solid fa-trash"></i> Hapus</button></div>');
            
            $('.claim_add').summernote({
                width: 2000,
                height: 250,
            });
        }
    }

    function deleteClaimForm(no) {
        
        if (countClaim() > 1) {
            $("#claim_delete_button_"+no).remove();
            $("#claim_input_"+no).remove();
        }
    }

    function countClaim() {
        var count = $('.claim').length
        return count;
    }
</script>
@endpush