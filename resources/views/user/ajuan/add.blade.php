@extends('template.main')

@section('page-title', 'Tambah Ajuan')

@section('content')
<div class="page-heading">
  <h3>Tambah Ajuan</h3>
</div>
<div class="page-content">
    <section class="section">

        <form action="{{ route('user.ajuan.store', ['patentDetail' => $patentDetail->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- detail --}}
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="mb-5">Detail</h5> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
    
                                {{-- Jenis Paten --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Jenis Paten *</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <select class="form-select" name="patent_type_id" id="patent_type_id">
                                        <option value="">- Pilih Jenis Paten -</option>
                                        @foreach ($patent_types as $patent_type)
                                        <option value="{{ $patent_type->id }}" @selected( old('patent_type_id', $patentDetail->patent_type_id) == $patent_type->id ) >{{ $patent_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patent_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                
                                {{-- Kriteria Pemohon --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Kriteria Pemohon *</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <select class="form-select" name="applicant_criteria_id" id="applicant_criteria_id">
                                        <option value="">- Pilih Kriteria Pemohon -</option>
                                        @foreach ($applicant_criterias as $applicant_criteria)
                                        <option value="{{ $applicant_criteria->id }}" @selected( old('applicant_criteria_id', $patentDetail->applicant_criteria_id) == $applicant_criteria->id ) >{{ $applicant_criteria->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('patent_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('user.ajuan.pemohon.add')
            @include('user.ajuan.pecahan.add')
            @include('user.ajuan.korespondensi.add')
            @include('user.ajuan.inventor.add')
            @include('user.ajuan.isi_dokumen.add')
            @include('user.ajuan.attachment.add')
    
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
    var penciptaTable;
    var pemegangHakCiptaTable;
    var _token = "{{ csrf_token() }}";
    var _ajuan = "{{ $patentDetail->id }}";
</script>
@endsection