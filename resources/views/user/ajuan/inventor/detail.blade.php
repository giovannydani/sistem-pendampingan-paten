<div class="card">
    <div class="card-body">
        <h5 class="mb-5">Data Inventor</h5>
    <table class="table" id="pemegang-hak-cipta-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kewarganegaraan</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patentDetail->PatentInventor as $inventor)
            <tr>
                <td>{{$inventor->name}}</td>
                <td>{{$inventor->Nationality->name}}</td>
                <td>{{$inventor->complete_address}}</td>
                <td>{{$inventor->email}}</td>
                <td>{{$inventor->telephone}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>