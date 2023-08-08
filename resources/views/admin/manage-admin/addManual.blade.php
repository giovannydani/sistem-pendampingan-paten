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
                <form action="{{ route('admin.manage-admin.store') }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
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
                                    <div class="col-md-3">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-7 form-group">
                                        <input type="text" id="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="generatePassword()">Generate</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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
    function generatePassword() {
        var pass = Math.random().toString(36).substring(2,12)
        $('#password').val(pass);
    }
</script>
@endsection