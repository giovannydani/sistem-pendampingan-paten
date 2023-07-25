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
                <table class="table" id="application-table">
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
            applicationTypeTable =  $('#application-table').DataTable({
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
                    url : "{{route('admin.ajuan.data')}}",
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
                            var url_check = "{{url('/admin/ajuan/check')}}"+"/"+data;
                            var url_detail = "{{url('/admin/ajuan/detail')}}"+"/"+data;

                            if (row.is_finish || row.is_revision) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                </div>';
                            }else if (row.is_admin_process) {
                                return '\
                                <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                    <a href="'+url_detail+'" class="btn btn-primary btn-sm me-2 mb-1"><i class="fa-solid fa-info"></i> Detail</a>\
                                    <a href="'+url_check+'" class="btn btn-secondary btn-sm me-2 mb-1"><i class="fa-solid fa-pencil"></i> Check</a>\
                                </div>';
                            }

                        }
                    },
                ]
            });

        } );
    </script>
@endsection