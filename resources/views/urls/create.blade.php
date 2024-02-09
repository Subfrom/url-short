@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    URL Information
                </div>
                <div class="float-end">
                    <a href="{{ route('urls.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('urls.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="real_url" class="col-md-4 col-form-label text-md-end text-start"><strong>Real URL:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <input type="text" class="form-control" name="real_url" value="{{ old('real_url') }}" required>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Create URL">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection