<div class="card">
    <div class="card-body">
        @livewire('user.ajuan.inventor', ['id' => $patentDetail->id])
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('openModalAddInventor', event => {
            $('#addInventor').modal('show');
        })

        window.addEventListener('closeModalAddInventor', event => {
            $('#addInventor').modal('hide');
        })

        function countryFuncActionInventor() {
            if ($('#country_id').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
                $('#province_id_label_inventor').hide()
                $('#province_id_input_inventor').hide()
                $('#district_id_label_inventor').hide()
                $('#district_id_input_inventor').hide()
                $('#subdistrict_id_label_inventor').hide()
                $('#subdistrict_id_input_inventor').hide()
            }else{
                $('#province_id_label_inventor').show()
                $('#province_id_input_inventor').show()
                $('#district_id_label_inventor').show()
                $('#district_id_input_inventor').show()
                $('#subdistrict_id_label_inventor').show()
                $('#subdistrict_id_input_inventor').show()
            }
        }

        window.addEventListener('openModalEditInventor', event => {
            $('#editInventor').modal('show');
            countryFuncActionInventorEdit();
        })

        window.addEventListener('closeModalEditInventor', event => {
            $('#editInventor').modal('hide');
        })

        function countryFuncActionInventorEdit() {
            if ($('#country_id_edit').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
                $('#province_id_label_inventor_edit').hide()
                $('#province_id_input_inventor_edit').hide()
                $('#district_id_label_inventor_edit').hide()
                $('#district_id_input_inventor_edit').hide()
                $('#subdistrict_id_label_inventor_edit').hide()
                $('#subdistrict_id_input_inventor_edit').hide()
            }else{
                $('#province_id_label_inventor_edit').show()
                $('#province_id_input_inventor_edit').show()
                $('#district_id_label_inventor_edit').show()
                $('#district_id_input_inventor_edit').show()
                $('#subdistrict_id_label_inventor_edit').show()
                $('#subdistrict_id_input_inventor_edit').show()
            }
        }

        function deleteInventor(id) {
            console.log(id);
            var url = "{{url('/ajuan/add')}}"+"/"+_ajuan+"/inventor/"+id;

            console.log(url);
            Swal.fire({
                title: 'Anda yakin??',
                text: "Menghapus inventor paten",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'DELETE',
                        data: {_token:_token},
                        success: function(data) {
                            console.log(data);
                            Livewire.emit('deleteInventor');
                            Swal.fire(
                                'Sukses',
                                'Menghapus inventor paten',
                                'success'
                            )
                        }
                    });
                }
            })
        }

        function coba(id) {
            console.log(id);
        }
    </script>
@endpush