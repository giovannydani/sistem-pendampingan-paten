@extends('template.main')

@section('page-title', 'Template Document')

@section('content')
<div class="page-heading">
  <h3>Template Document</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($templateDocuments as $templateDocument)
                    <div class="col-lg-3">
                        <div class="card" style="background-color: #25396f">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <div class="card-body text-center">
                                <p style="font-size: 50px; color: white" class="text-center"><i class="bi bi-file-earmark"></i></p>
                                <h5 class="card-title" style="color: white">{{$templateDocument->name}}</h5>
                                <a href="{{ route('user.template.download', ['templateDocument' => $templateDocument->id]) }}" class="btn btn-primary">Download</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
@endsection