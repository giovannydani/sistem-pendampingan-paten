@extends('template.main')

@section('page-title', 'Log Ajuan')

@section('content')
<div class="page-heading">
  <h3>Log Ajuan</h3>
</div>
<div class="page-content">
    <section class="section">

        <div class="card">
            <div class="card-body">
                @foreach ($patentDetail->PatentComments as $comment)
                <div class="col-md-12">
                    <label class="mt-2" >({{$comment->created_at->format('d-m-Y h:m')}})</label >
                </div>
                <div class="col-md-12 form-group mt-2">
                    <textarea rows="3" placeholder="Uraian Singkat Ciptaan" class="form-control" readonly disabled>{{$comment->comment}}</textarea>
                </div>
                @endforeach
            </div>
        </div>

    </section>
</div>
@endsection