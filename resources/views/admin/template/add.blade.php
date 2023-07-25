@extends('template.main')

@section('page-title', 'Add Template')

@section('content')
<div class="page-heading">
  <h3>Add Template Document</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.template.store') }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Template Name" value="{{ old('name') }}">
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
@endsection