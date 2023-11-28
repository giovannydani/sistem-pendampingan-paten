<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Lampiran</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Deskripsi (Indonesia)</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="description_attachment_id" name="description_attachment_id">
                        @error('description_attachment_id') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Deskripsi (Inggris)</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="description_attachment_en" name="description_attachment_en">
                        @error('description_attachment_en') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Sequence</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="sequence_attachment" name="sequence_attachment">
                        @error('sequence_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Claim</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="claim_attachment" name="claim_attachment">
                        @error('claim_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Abstract</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="abstract_attachment" name="abstract_attachment">
                        @error('abstract_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Gambar Teknik</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="technical_pict_attachment" name="technical_pict_attachment">
                        @error('technical_pict_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Gambar yang akan digunakan di pengumuman</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="pict_to_show_on_announcement_attachment" name="pict_to_show_on_announcement_attachment">
                        @error('pict_to_show_on_announcement_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Surat Pengalihan Hak</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="transfer_of_rights_letter_attachment" name="transfer_of_rights_letter_attachment">
                        @error('transfer_of_rights_letter_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Surat Kuasa</h5>
                    </div>
                    <div class="form-group px-2">
                        <input type="file" class="form-control" id="power_of_attorney_attachment" name="power_of_attorney_attachment">
                        @error('power_of_attorney_attachment') <span class="text-warning">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>