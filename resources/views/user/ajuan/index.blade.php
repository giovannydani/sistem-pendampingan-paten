@extends('template.main')

@section('page-title', 'Ajuan')

@section('content')
<div class="page-heading">
  <h3>Ajuan</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- <a href="{{ route('admin.application-type.create') }}" class="btn btn-primary me-3 mb-3"><i class="fa-solid fa-plus"></i> Add Ajuan</a> --}}
                <button class="btn btn-primary me-3 mb-3" onclick="addApplication()"><i class="fa-solid fa-plus"></i> Add Ajuan</button>
                <table class="table" id="ajuan-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Invensi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var templateTable;
        $(document).ready( function () {
            var _token = "{{ csrf_token() }}";
            ajuanTable =  $('#ajuan-table').DataTable({
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                // scrollX: true,
                // responsive: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 0,
                    right: 1,
                },
                ajax: {
                    url : "{{route('user.ajuan.data')}}",
                    type : 'POST',
                    data: {
                        _token:_token,
                    },
                },
                columns: [
                    { 
                        "searchable": false,
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        } 
                    },
                    { data: 'patent_document.title_id' },
                    { data: 'status_text' },
                    {
                        orderable: false,
                        "searchable": false,
                        data: 'id',
                        render: function(data, type, row){
                            var url_edit = "{{url('/ajuan/edit')}}"+"/"+data;
                            var url_log = "{{url('/ajuan/log')}}"+"/"+data;
                            var url_detail = "{{url('/ajuan/detail')}}"+"/"+data;
                            var url_upload_transfer_evidence = "{{url('/ajuan/upload_transfer_evidence')}}"+"/"+data;
                            var delete_action = "onclick=\"deleteAjuan('"+data+"')\"";

                            if (row.is_admin_check) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                </div>';
                            }
                            else if (row.is_admin_process || row.is_upload_payment) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                </div>';
                            }
                            else if (row.is_certificate_finish || row.is_payment_failed) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                    <a href="'+url_upload_transfer_evidence+'" class="btn btn-secondary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Upload Bukti Pembayaran</a>\
                                </div>';
                            }
                            else if (row.is_revision) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                    <a href="'+url_log+'" class="btn btn-secondary btn-sm me-2 mb-1"><i class="fa-solid fa-book"></i> Log</a>\
                                    <a href="'+url_edit+'" class="btn btn-warning btn-sm me-2 mb-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>\
                                    <button type="button" class="btn btn-sm btn-danger mb-1 me-2" '+delete_action+'><i class="fa-solid fa-trash-can"></i> Delete</button>\
                                </div>';
                            }
                            else if (row.is_finish) {
                                var link_certificate = row.registration_certificate['file_url'];

                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                    <a href="'+link_certificate+'" target="_blank" class="btn btn-secondary btn-sm me-2 mb-1"><i class="fa-solid fa-book"></i> Download Surat Pencatatan</a>\
                                </div>';
                            }

                        }
                    },
                ]
            });

            // $('#ajuan-table').DataTable();
        } );

        function deleteAjuan(id) {
            var _token = "{{ csrf_token() }}";
            var url = "{{url('/ajuan/delete/')}}"+"/"+id;
            Swal.fire({
                title: 'Anda yakin ?',
                text: "Menghapus ajuan ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'DELETE',
                        data: {_token:_token},
                        success: function(data) {
                            Swal.fire(
                                'Sukses',
                                'Menghapus ajuan',
                                'success'
                            )

                            ajuanTable.ajax.reload();
                        }
                    });
                }
            })
        }

        function addApplication() {
            // console.log('add');
            var _token = "{{ csrf_token() }}";
            var url = "{{ route('user.ajuan.generateAdd') }}";
            $.ajax({
                url: url,
                type:'POST',
                data: {_token:_token},
                success: function(data) {
                    console.log(data);
                    var url_redirect = "{{ url('ajuan/add/') }}"+"/"+data;
                    window.location.replace(url_redirect);
                    // ajuanTable.ajax.reload();

                }
            });
        }
    </script>
@endsection