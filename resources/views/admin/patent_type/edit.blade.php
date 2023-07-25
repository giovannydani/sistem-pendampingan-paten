@extends('template.main')

@section('page-title', 'Add Template')

@section('content')
<div class="page-heading">
  <h3>Patent Type</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.patent-type.update', ['patentType' => $patentType->id]) }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Nama Tipe</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nama Tipe" value="{{ old('name', $patentType->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
@endsection