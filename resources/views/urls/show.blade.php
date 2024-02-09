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

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Real URL:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <a href="{{ $url->real_url }}">Link</a>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Short URL:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <a href="{{ route('shortener-url', $url->short_url) }}" target="_blank">
                                {{ route('shortener-url', $url->short_url) }}
                            </a>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>User Make :</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <span class="badge bg-primary">{{ $user->username }}</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>    
@endsection