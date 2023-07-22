<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Isi Dokumen</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                    <div class="col-md-4">
                        <label class="mt-2">Judul Invensi (Indonesia)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{$patentDetail->PatentDocument->title_id}}</p>
                    </div>
                </div>
            </div>
            @if ($patentDetail->PatentDocument->title_en)
            <div class="col-md-6">
                <div class="row">
                    
                    {{-- Kriteria Pemohon --}}
                    <div class="col-md-4">
                        <label class="mt-2">Judul Invensi (Inggris)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <p class="form-control">{{$patentDetail->PatentDocument->title_en}}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <div class="col-md-4">
                    <label class="mt-2">Klaim </label >
                </div>
            </div>
        </div>
        <div class="row mt-5" id="container_form_claim">
            @foreach ($patentDetail->PatentClaims as $claim)
            <div class="col-md-10 form-group" id="claim_input_{{$loop->index}}">
                <div class="input-group mb-3">
                    <textarea name="claim_add[]" id="claim_add" class="claim_add" cols="150" rows="4" readonly>{{ $claim->claim }}</textarea>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label class="mt-2">Abstrak (Indonesia)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <textarea name="invention_abstract_id" id="invention_abstract_id" cols="30" rows="10" class="form-control" readonly>{{$patentDetail->PatentDocument->abstract_id}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @if ($patentDetail->PatentDocument->title_en)
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label class="mt-2">Abstrak (Inggris)</label >
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group mb-3">
                            <textarea name="invention_abstract_en" id="invention_abstract_en" cols="30" rows="10" class="form-control" readonly>{{$patentDetail->PatentDocument->title_en}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.claim_add').summernote({
                width: 2000,
                height: 250,
            });
        });
    </script>
@endpush