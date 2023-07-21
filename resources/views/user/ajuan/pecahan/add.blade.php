<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Pecahan</h5>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    {{-- is_fractions --}}
                    <div class="col">
                        <label class="mt-2">Apakah Permohonan Paten ini pecahan dari permohonan sebelumnya*</label>
                    </div>
                    <div class="col form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_fractions" id="is_fractions_yes" value="yes" @checked(old('is_fractions', 'yes') == 'yes')>
                            <label class="form-check-label" for="is_fractions_yes">
                              Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_fractions" id="is_fractions_no" value="no" @checked(old('is_fractions', 'yes') == 'no')>
                            <label class="form-check-label" for="is_fractions_no">
                              No
                            </label>
                        </div>
                        @error('is_fractions') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="row">
                    {{-- fractions_number --}}
                    <div class="col-md-4" id="fractions_number_label">
                        <label class="mt-2">Nomor Permohonan Induk</label >
                    </div>
                    <div class="col-md-8 form-group" id="fractions_number_input">
                        <div class="input-group mb-3">
                            <input type="text" id="fractions_number" class="form-control" name="fractions_number" placeholder="Nama" value="{{ old('fractions_number') }}">
                        </div>
                        @error('fractions_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="row">
                    <div class="row">
                        {{-- fractions_date --}}
                        <div class="col-md-4" id="fractions_date_label">
                            <label class="mt-2">Tanggal Penerimaan Permohonan Induk</label >
                        </div>
                        <div class="col-md-8 form-group" id="fractions_date_input">
                            <div class="input-group mb-3">
                                <input type="date" id="fractions_date" class="form-control" name="fractions_date" placeholder="Nama" value="{{ old('fractions_date') }}">
                            </div>
                            @error('fractions_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showHide(radioValue) {
        if (radioValue == 'yes') {
            $('#fractions_number_input').show();            
            $('#fractions_number_label').show();            
            $('#fractions_date_input').show();            
            $('#fractions_date_label').show();            
        }else{
            $('#fractions_number_input').hide();            
            $('#fractions_number_label').hide();            
            $('#fractions_date_input').hide();            
            $('#fractions_date_label').hide();
        }
    }

    $(document).ready(function () {
        var radioValue = $("input[name='is_fractions']:checked").val();

        showHide(radioValue);
    });
    
    
    $("input[name='is_fractions']").on('change',function(){
        var radioValue = $("input[name='is_fractions']:checked").val();

        showHide(radioValue);
    });
</script>
@endpush