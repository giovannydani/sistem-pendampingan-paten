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
                <div class="row">
                    <div class="col-md-12">
                        <h5>Filter Ajuan</h5>
                    </div>
                    <div class="col-md-3">
                        <label>Mulai Tanggal</label>
                    </div>
                    <div class="col-md-3 form-group">
                        <input type="date" id="start_date" class="form-control" name="start_date">
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                    </div>
                    <div class="col-md-3 form-group">
                        <input type="date" id="end_date" class="form-control" name="end_date">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                
                <table class="table" id="application-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Invensi</th>
                            <th>Nama yang mengajukan</th>
                            <th>Status</th>
                            <th>Tanggal Submit</th>
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
        var _startDate;
        var _endDate;
        var _token = "{{ csrf_token() }}";

        function table() {
            applicationTypeTable = $('#application-table').DataTable({
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
                        _startDate : _startDate,
                        _endDate : _endDate,
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
                    { data: 'owner.name' },
                    { data: 'status_text' },
                    { data: 'submited_at' },
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
        }

        $(document).ready( function () {
            _startDate = $('#start_date').val();
            _endDate = $('#end_date').val();

            table();

        } );
        
        $('#start_date, #end_date').on('change', function () {
            _startDate = $('#start_date').val();
            _endDate = $('#end_date').val();
            applicationTypeTable.destroy();
            table();
            console.log($('#start_date').val());
            console.log($('#end_date').val());
        });
    </script>
@endsection