@extends('template.main')

@section('page-title', 'Detail Ajuan')

@section('content')
<div class="page-heading">
  <h3>Detail Ajuan</h3>
</div>
<div class="page-content">
    <section class="section">

            {{-- detail --}}
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="mb-5">Detail</h5> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
    
                                {{-- Jenis Paten --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Jenis Paten</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <p class="form-control">{{$patentDetail->PatentType->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                
                                {{-- Kriteria Pemohon --}}
                                <div class="col-md-4">
                                    <label class="mt-2">Kriteria Pemohon</label >
                                </div>
                                <div class="col-md-8 form-group">
                                    <p class="form-control">{{$patentDetail->ApplicantCriteria->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @include('user.ajuan.pemohon.detail') --}}
            @include('user.ajuan.pemohon.multi.detail')

            @if ($patentDetail->is_fractions)
            @include('user.ajuan.pecahan.detail')
            @endif

            @include('user.ajuan.korespondensi.add')

            @include('user.ajuan.inventor.detail')

            @include('user.ajuan.isi_dokumen.detail')

            @include('user.ajuan.attachment.detail')
        
            @if ($patentDetail->PatentNewComment)
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <label class="mt-2" >Comment</label >
                    </div>
                    <div class="col-md-12 form-group mt-2">
                        <textarea rows="3" placeholder="Uraian Singkat Ciptaan" class="form-control" readonly disabled>{{$patentDetail->PatentNewComment->comment}}</textarea>
                    </div>
                </div>
            </div>
            @endif

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