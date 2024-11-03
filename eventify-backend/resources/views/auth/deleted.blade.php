@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.errors')
            @include('partials.messages')
            <div class="card">
                <div class="card-header">{{ __('Account Deleted') }}</div>
                <div class="card-body">
                    {{ __('Your account was deleted. Contact an admin for further information.') }}
                    {{ __('Thank you! - Eventify') }},
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
