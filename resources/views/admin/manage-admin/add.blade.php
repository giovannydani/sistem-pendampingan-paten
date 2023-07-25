@extends('template.main')

@section('page-title', 'Add Admin')

@section('content')
<div class="page-heading">
  <h3>Add Admin</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="add-admin-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
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
            addAdminTable =  $('#add-admin-table').DataTable({
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
                    url : "{{route('admin.manage-admin.dataCreate')}}",
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
                    { data: 'name' },
                    { data: 'email' },
                    {
                        orderable: false,
                        "searchable": false,
                        data: 'id',
                        render: function(data, type, row){
                            var delete_action = "onclick=\"selectAdmin('"+data+"')\"";

                            return '\
                            <div class="btn-group" role="group">\
                                <button type="button" class="btn btn-sm btn-primary mb-1 me-2" '+delete_action+'><i class="fa-solid fa-check"></i> Select</button>\
                            </div>';

                        }
                    },
                ]
            });

        } );

        function selectAdmin(id) {
            var _token = "{{ csrf_token() }}";
            var url = "{{url('/admin/manage-admin/add/')}}"+"/"+id;
            var url_redirect = "{{ route('admin.manage-admin.index') }}";
            Swal.fire({
                title: 'Are you sure?',
                text: "Select This User To Become a Admin",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Select It!',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'POST',
                        data: {_token:_token},
                        success: function(data) {
                            // Swal.fire(
                            //     'Success',
                            //     'Select Type Data',
                            //     'success'
                            // )
                            Swal.fire({
                                title: 'Success',
                                text: "Select Type Data",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Back To Manage Admin',
                                cancelButtonText: 'I Want To Add More Admin'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.replace(url_redirect);
                                }
                            });

                            addAdminTable.ajax.reload();
                        }
                    });
                }
            })
        }

        function restoreApplicationType(id) {
            var _token = "{{ csrf_token() }}";
            var url = "{{url('/admin/application-type/restore/')}}"+"/"+id;
            Swal.fire({
                title: 'Are you sure?',
                text: "Restore this type",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Restore It!',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'POST',
                        data: {_token:_token},
                        success: function(data) {
                            Swal.fire(
                                'Success',
                                'Restore Type Data',
                                'success'
                            )

                            addAdminTable.ajax.reload();
                        }
                    });
                }
            })
        }
    </script>
@endsection