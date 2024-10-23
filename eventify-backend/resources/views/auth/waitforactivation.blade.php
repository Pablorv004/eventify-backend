@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.errors')
            @include('partials.messages')
            <div class="card">
                <div class="card-header">{{ __('Thank you for registering!') }}</div>
                <div class="card-body">
                    {{ __('Please wait patiently for an admin to activate your account.') }}
                    {{ __('Thank you! - Eventify') }},
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
