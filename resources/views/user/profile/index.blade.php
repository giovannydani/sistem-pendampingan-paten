@extends('template.main')

@section('page-title', 'Profile')

@section('content')
<div class="page-heading">
  <h3>Profile</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <form action="{{ route('user.profile.change-detail') }}" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12 mb-3">
                                        <h5>Detail</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Application Type Name" value="{{ old('name', $user->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-sm-12 d-flex mt-2">
                                        <button type="submit" class="btn btn-primary me-2 mb-1"><i class="fa-solid fa-plus"></i> Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <form action="{{ route('user.profile.change-password') }}" method="POST" class="form form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="col-sm-12 mb-3">
                                        <h5>Password</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Old Password</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Old Password">
                                        @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>New Password</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="New Password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Confirm New Password</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
                                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-sm-12 d-flex mt-2">
                                        <button type="submit" class="btn btn-primary me-2 mb-1"><i class="fa-solid fa-plus"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection