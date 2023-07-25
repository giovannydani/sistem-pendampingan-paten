@extends('template.main')

@section('page-title', 'Dashboard')

@section('content')
<div class="page-heading">
  <h3>Statistics</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12 col-lg-12">
      <div class="row">
        <div class="col-6 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total User</h6>
                  <h6 class="font-extrabold mb-0">{{$total_user_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">User</h6>
                  <h6 class="font-extrabold mb-0">{{$user_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Admin</h6>
                  <h6 class="font-extrabold mb-0">{{$admin_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- Ajuan --}}
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon green mb-2">
                    <i class="fa-solid fa-book"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan</h6>
                  <h6 class="font-extrabold mb-0">{{$total_ajuan_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon green mb-2">
                    <i class="fa-solid fa-book"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Admin Process)</h6>
                  <h6 class="font-extrabold mb-0">{{$admin_process_ajuan_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon green mb-2">
                    <i class="fa-solid fa-book"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Revisi)</h6>
                  <h6 class="font-extrabold mb-0">{{$revision_ajuan_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div
                  class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                >
                  <div class="stats-icon green mb-2">
                    <i class="fa-solid fa-book"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Selesai)</h6>
                  <h6 class="font-extrabold mb-0">{{$finish_ajuan_count}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
    <!-- Need: Apexcharts -->
    <script src="{{ asset('asset/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('asset/js/pages/dashboard.js') }}"></script>
@endsection