@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in as '. Auth::user()->username) }}
                </div>
                <div class="card-header">{{ __('This is the dashboard with all possible operations for your account') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
