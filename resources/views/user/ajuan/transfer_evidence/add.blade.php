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
                <form id="upload_certificate_form" action="{{ route('user.ajuan.store_upload_transfer_evidence', ['patentDetail' => $patentDetail->id]) }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="imageContainer">
                                            <img id="selectedImage" alt="Please Upload Transfer Evidence" src="" style="max-width: 100%; height: auto; display: block; margin: auto;" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>File Surat Pencatatan</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="file" id="file" class="form-control" name="file" onchange="displayImage()">
                                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end mt-2">
                                        <button id="submit_button_form" type="button" class="btn btn-primary me-2 mb-1"><i class="fa-solid fa-plus"></i> Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-2 mb-1"><i class="fa-solid fa-broom"></i> Clear</button>
                                    </div>
                                </div>
                            </div>
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

        function displayImage() {
            var input = document.getElementById('file');
            var imageContainer = document.getElementById('imageContainer');
            var selectedImage = document.getElementById('selectedImage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                imageContainer.style.display = 'block';
            } else {
                imageContainer.style.display = 'none';
            }
        }
    </script>
@endsection