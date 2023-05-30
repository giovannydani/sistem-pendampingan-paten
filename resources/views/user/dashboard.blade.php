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
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="fa-solid fa-file"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">
                    Total Ajuan
                  </h6>
                  <h6 class="font-extrabold mb-0">0</h6>
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
                  <div class="stats-icon blue mb-2">
                    <i class="fa-solid fa-file"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Proses Admin)</h6>
                  <h6 class="font-extrabold mb-0">0</h6>
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
                    <i class="fa-solid fa-file"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Revisi)</h6>
                  <h6 class="font-extrabold mb-0">0</h6>
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
                  <div class="stats-icon red mb-2">
                    <i class="fa-solid fa-file"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Ajuan (Selesai)</h6>
                  <h6 class="font-extrabold mb-0">0</h6>
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
@endsection