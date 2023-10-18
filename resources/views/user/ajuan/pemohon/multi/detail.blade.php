<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Pemohon</h5>
    <table class="table" id="pemegang-hak-cipta-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kewarganegaraan</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Perusahaan / Institusi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patentDetail->PatentApplicants as $inventor)
            <tr>
                <td>{{$inventor->name}}</td>
                <td>{{$inventor->Nationality->name}}</td>
                <td>{{$inventor->complete_address}}</td>
                <td>{{$inventor->email}}</td>
                <td>{{$inventor->telephone}}</td>

                <td>{{$inventor->is_company ? 'Ya' : 'Tidak'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>