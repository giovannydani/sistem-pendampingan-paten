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

            @include('user.ajuan.pemohon.detail')

            @if ($patentDetail->is_fractions)
            @include('user.ajuan.pecahan.detail')
            @endif

            @include('user.ajuan.korespondensi.add')

            @include('user.ajuan.inventor.detail')

            @include('user.ajuan.isi_dokumen.detail')

            @include('user.ajuan.attachment.detail')
        
            {{-- @if ($patentDetail->PatentNewComment)
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <label class="mt-2" >Comment*</label >
                    </div>
                    <div class="col-md-12 form-group mt-2">
                        <textarea rows="3" placeholder="Uraian Singkat Ciptaan" class="form-control" readonly disabled>{{$patentDetail->PatentNewComment->comment}}</textarea>
                    </div>
                </div>
            </div>
            @endif --}}
            <div class="card">
                <div class="card-body">
                    <form id="comment_paten_form" action="{{route('admin.ajuan.store', ['patentDetail' => $patentDetail->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if ($patentDetail->PatentNewComment)
                            <div class="col-md-12">
                                <label class="mt-2" >Comment*</label >
                            </div>
                            <div class="col-md-12 form-group mt-2">
                                <textarea rows="3" placeholder="Uraian Singkat Ciptaan" class="form-control" readonly disabled>{{$patentDetail->PatentNewComment->comment}}</textarea>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <label class="mt-2" >New Comment*</label >
                            </div>
                            <div class="col-md-12 form-group mt-2">
                                <textarea name="comment" id="comment" rows="3" placeholder="Komen" class="form-control">{{old('comment')}}</textarea>
                                @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" id="submit_button_comment_form" type="button">Submit Comment</button>
                                <button class="btn btn-secondary" id="finish_button_comment_form" type="button">Finish Ajuan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </section>
</div>
@endsection

@section('js')
<script>
    var penciptaTable;
    var pemegangHakCiptaTable;
    var _token = "{{ csrf_token() }}";
    var _ajuan = "{{ $patentDetail->id }}";

    $("#submit_button_comment_form").on('click', function (event){
        event.preventDefault();
        submitComment($("#comment_paten_form"));
    });

    function submitComment(event) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Submit this comment",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit It!',
            cancelButtonText: 'Cancel'
            }).then((result) => {
            if (result.isConfirmed) {
                event.submit();
            }
        })
    }

    $("#finish_button_comment_form").on('click', function (event){
        finishApplication();
    });

    function finishApplication() {
        var _token = "{{ csrf_token() }}";
        var url = "{{route('admin.ajuan.finishAjuan', ['patentDetail' => $patentDetail->id])}}";
        var url_redirect = "{{route('admin.ajuan.index')}}";
        Swal.fire({
            title: 'Anda yakin',
            text: "Ingin Menyelesaikan Ajuan Ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Selesaikan',
            cancelButtonText: 'Cancel'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type:'PUT',
                    data: {_token:_token},
                    success: function(data) {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Menyelesaikan Ajuan",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok',
                            showCloseButton: false,
                            showCancelButton: false,
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace(url_redirect);
                            }
                        })
                    }
                });
            }
        })
    }
</script>
@endsection