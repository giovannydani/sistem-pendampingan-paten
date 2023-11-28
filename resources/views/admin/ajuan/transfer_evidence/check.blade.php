@extends('template.main')

@section('page-title', 'Upload Transfer Evidence')

@section('content')
<div class="page-heading">
  <h3>Upload Transfer Evidence</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- <form id="upload_certificate_form" action="{{ route('admin.ajuan.store_check_transfer_evidence', ['patentDetail' => $patentDetail->id]) }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf --}}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="imageContainer">
                                            <img id="selectedImage" alt="Please Upload Transfer Evidence" src="{{$patentDetail->TransferEvidence->file_url}}" style="max-width: 100%; height: auto; display: block; margin: auto;" >
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end mt-2">
                                        <button id="valid_button" type="button" class="btn btn-primary me-2 mb-1" onclick="evidanceValid()"><i class="fa-solid fa-check"></i> Pembayaran Valid</button>
                                        <button id="invalid_button" type="button" class="btn btn-danger me-2 mb-1" onclick="evidanceInvalid()"><i class="fa-solid fa-xmark"></i> Pembayaran Tidak Valid</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script>
        var _token = "{{ csrf_token() }}";
        var url_redirect = "{{route('admin.ajuan.index')}}";

        $("#submit_button_form").on('click', function (event){
            event.preventDefault();
            submitComment($("#upload_certificate_form"));
        });

        function submitComment(event) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Submit this certificate",
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

        function evidanceValid() {
            var url = "{{route('admin.ajuan.valid_transfer_evidence', ['patentDetail' => $patentDetail->id])}}";
            Swal.fire({
                title: 'Anda yakin',
                text: "Pembayaran ini benar benar valid?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'POST',
                        data: {_token:_token},
                        success: function(data) {
                            Swal.fire({
                                title: 'Sukses',
                                text: "Verifikasi Pembayaran",
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
            });
        }

        function evidanceInvalid() {
            var url = "{{route('admin.ajuan.invalid_transfer_evidence', ['patentDetail' => $patentDetail->id])}}";
            Swal.fire({
                title: 'Anda yakin',
                text: "Pembayaran ini tidak valid?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'POST',
                        data: {_token:_token},
                        success: function(data) {
                            Swal.fire({
                                title: 'Sukses',
                                text: "Verifikasi Pembayaran",
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