<div class="card">
    <div class="card-body">
        @livewire('user.ajuan.pemohon', ['id' => $patentDetail->id])
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('openModalAddApplicant', event => {
            $('#addApplicant').modal('show');
        })

        window.addEventListener('closeModalAddApplicant', event => {
            $('#addApplicant').modal('hide');
        })

        function countryFuncActionApplicant() {
            if ($('#country_id_applicant').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
                $('#province_id_label_applicant').hide()
                $('#province_id_input_applicant').hide()
                $('#district_id_label_applicant').hide()
                $('#district_id_input_applicant').hide()
                $('#subdistrict_id_label_applicant').hide()
                $('#subdistrict_id_input_applicant').hide()
            }else{
                $('#province_id_label_applicant').show()
                $('#province_id_input_applicant').show()
                $('#district_id_label_applicant').show()
                $('#district_id_input_applicant').show()
                $('#subdistrict_id_label_applicant').show()
                $('#subdistrict_id_input_applicant').show()
            }
        }

        window.addEventListener('openModalEditApplicant', event => {
            $('#editApplicant').modal('show');
            countryFuncActionApplicantEdit();
        })

        window.addEventListener('closeModalEditApplicant', event => {
            $('#editApplicant').modal('hide');
        })

        function countryFuncActionApplicantEdit() {
            if ($('#country_id_edit_applicant').val() != '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
                $('#province_id_label_applicant_edit').hide()
                $('#province_id_input_applicant_edit').hide()
                $('#district_id_label_applicant_edit').hide()
                $('#district_id_input_applicant_edit').hide()
                $('#subdistrict_id_label_applicant_edit').hide()
                $('#subdistrict_id_input_applicant_edit').hide()
            }else{
                $('#province_id_label_applicant_edit').show()
                $('#province_id_input_applicant_edit').show()
                $('#district_id_label_applicant_edit').show()
                $('#district_id_input_applicant_edit').show()
                $('#subdistrict_id_label_applicant_edit').show()
                $('#subdistrict_id_input_applicant_edit').show()
            }
        }

        function deleteApplicant(id) {
            console.log(id);
            var url = "{{url('/ajuan/add')}}"+"/"+_ajuan+"/applicant/"+id;

            console.log(url);
            Swal.fire({
                title: 'Anda yakin??',
                text: "Menghapus pemohon paten",
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
                            Livewire.emit('deleteApplicant');
                            Swal.fire(
                                'Sukses',
                                'Menghapus Pemohon paten',
                                'success'
                            )
                        }
                    });
                }
            })
        }
    </script>
@endpush