<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Lampiran</h5>
        <div class="row">
            @if ($patentDetail->PatentAttachment->attachment['description_id'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Deskripsi (Indonesia)</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['description_id'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif

            @if ($patentDetail->PatentAttachment->attachment['description_en'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Deskripsi (Inggris)</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['description_en'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif

            @if ($patentDetail->PatentAttachment->attachment['sequence'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Sequence</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['sequence'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif

            @if ($patentDetail->PatentAttachment->attachment['claim'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Claim</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['claim'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif

            @if ($patentDetail->PatentAttachment->attachment['abstract'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Abstract</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['abstract'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif

            @if ($patentDetail->PatentAttachment->attachment['technical_pict'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Gambar Teknik</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['technical_pict'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if ($patentDetail->PatentAttachment->attachment['pict_to_show_on_announcement'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Gambar yang akan digunakan di pengumuman</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['pict_to_show_on_announcement'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if ($patentDetail->PatentAttachment->attachment['power_of_attorney'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Surat Kuasa</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['power_of_attorney'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if ($patentDetail->PatentAttachment->attachment['transfer_of_rights_letter'])
            <div class="col-md-4">
                <div class="card" style="width: 18rem; background-color: #435ebe">
                    <i class="fa-solid fa-file card-img-top pt-5" style="font-size: 100px; text-align: center;  color: white"></i>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title" style="text-align: center; color: white">Surat Pengalihan Hak</h5>
                        <a href="{{asset('storage/'. $patentDetail->PatentAttachment->attachment['transfer_of_rights_letter'])}}" target="_blank" class="btn btn-secondary">Open</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>