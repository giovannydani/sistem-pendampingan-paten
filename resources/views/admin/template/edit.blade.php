@extends('template.main')

@section('page-title', 'Dashboard')

@section('content')
<div class="page-heading">
  <h3>Edit Template Document</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.template.update', ['templateDocument' => $templateDocument->id]) }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Template Name" value="{{ old('name', $templateDocument->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>File</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="file" id="file" class="form-control" name="file">
                                        <div id="emailHelp" class="form-text">Biarkan kosong jika tidak merubah file</div>
                                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="col-sm-12 d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary me-2 mb-1"><i class="fa-solid fa-plus"></i> Submit</button>
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
        var bankTable;
        $(document).ready( function () {
            var _token = "{{ csrf_token() }}";
            bankTable =  $('#bank-table').DataTable({
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
                "searching": false,
                ajax: {
                    url : "{{route('admin.template.data')}}",
                    type : 'POST',
                    data: {
                        _token:_token,
                    },
                },
                columns: [
                    { data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        } 
                    },
                    { data: 'name' },
                    {
                        data: 'id',
                        render: function(data, type, row){
                            var url_edit = "{{url('/bank/')}}"+"/"+data+"/edit";
                            return '\
                            <div class="btn-group" role="group" aria-label="PIC Details Action">\
                                <a href="'+url_edit+'" class="btn btn-warning btn-sm me-2 mb-1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>\
                                <button type="button" class="btn btn-sm btn-danger mb-1 me-2" onclick="deleteBank('+data+')"><i class="fa-solid fa-trash-can"></i> Delete</button>\
                            </div>';
                        }
                    },
                ]
            });

            // $('#bank-table').DataTable();
        } );

        function deleteBank(id) {
            var _token = "{{ csrf_token() }}";
            var url = "{{url('/bank/')}}"+"/"+id;
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete this bank",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete It!',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'DELETE',
                        data: {_token:_token},
                        success: function(data) {
                            Swal.fire(
                                'Success',
                                'Delete Bank Data',
                                'success'
                            )

                            bankTable.ajax.reload();
                        }
                    });
                }
            })
        }
    </script>
@endsection