<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Pecahan</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    {{-- fractions_number --}}
                    <div class="col-md-4" id="fractions_number_label">
                        <label class="mt-2">Nomor Permohonan Induk</label >
                    </div>
                    <div class="col-md-8 form-group" id="fractions_number_input">
                        <p class="form-control">{{$patentDetail->fractions_number}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="row">
                        {{-- fractions_date --}}
                        <div class="col-md-4" id="fractions_date_label">
                            <label class="mt-2">Tanggal Penerimaan Permohonan Induk</label >
                        </div>
                        <div class="col-md-8 form-group" id="fractions_date_input">
                            <p class="form-control">{{$patentDetail->fractions_date}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>