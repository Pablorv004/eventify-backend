@extends('layouts.app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container bootstrap snippets bootdey">
        @include('partials.errors')
        @include('partials.messages')
        <h1 class="text-primary">Edit Profile</h1>
        <hr>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset($user->profile_picture) }}" class="avatar img-circle img-thumbnail"
                        alt="avatar">

                    <!-- <input type="file" class="form-control"> -->
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">

                <h3>Personal info </h3>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('users.update', [$user]) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group mb-2">
                        <label class="col-lg-3 control-label">Name:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="{{ $user->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="{{ $user->email }}" name="email">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="col-lg-3 control-label">User type:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                <select id="user_role" class="form-control" name="user_role">
                                    <option value="User" {{ $user->role == 'u' ? 'selected' : '' }}>User</option>
                                    <option value="Organizer" {{ $user->role == 'o' ? 'selected' : '' }}>Organizer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h4>Account status</h4>
                    </div>
                    <div class="mt-1">
                        @if($user->email_confirmed == 1)
                            <button
                                type="button" 
                                id="validated-button"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-validated="{{ $user->activated }}"
                                onclick="handleValidatedButton(event)"
                                class="btn {{ $user->activated == 1 ? 'btn-success' : 'btn-danger' }}">{{ $user->activated == 1 ? 'Validated' : 'Not validated' }}</button>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>Validate</button>
                        @endif
                        <button
                            type="button"
                            id="verified-button"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-verified="{{ $user->email_confirmed }}"
                            onclick="handleVerifiedButton(event)"
                            class="btn {{ $user->email_confirmed == 1 ? 'btn-success' : 'btn-danger' }} ms-2">{{ $user->email_confirmed == 1 ? 'Verified' : 'Not verified' }}</button>
                        <a type="button" 
                            id="deleted-button"
                            href="{{ route('toggle.softdelete', $user->id) }}"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-deleted="{{ $user->deleted }}"
                            onclick="handleDeletedButton(event)"
                            class="btn {{ $user->deleted == 1 ? 'btn-danger' : 'btn-success' }} ms-2">{{ $user->deleted == 1 ? 'Account deleted' : 'Account active' }}</a>
                    </div>
                    <div class="mt-5 text-end" style="margin-end: 22em">
                        <button type="submit" class="btn btn-success">Apply changes</button>
                        <a class="btn btn-danger ms-2 button-return" href="{{ route('users.index') }}">Return</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
@endsection

@section('scripts')
<script>
        function handleValidatedButton(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const validated = parseInt(button.getAttribute('data-validated'));

            let confirmation = "";
            if (validated === 0) {
                confirmation = confirm(`Are you sure you want to activate the account of the user ${userName}?`);
            } else {
                confirmation = confirm(`Are you sure you want to deactivate the account of the user ${userName}?`);
            }

            if (confirmation) {
                window.location.href = `/toggleuserstatus/${userId}`;
            }
        }

        function handleVerifiedButton(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const verified = parseInt(button.getAttribute('data-verified'));

            let confirmation = "";
            if (verified == 0) {
                confirmation = confirm(`Are you sure you want to manually verify the email of the user ${userName}?\n\nWARNING: This is not a recommended action`);
            } else {
                confirmation = confirm(`Are you sure you want to unverify the email of the user ${userName}?`);
            }

            if (confirmation) {
                window.location.href = `/toggleuserverified/${userId}`;
            }
        }

        function handleDeletedButton(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const deleted = parseInt(button.getAttribute('data-deleted'));

            let confirmation = "";
            if (deleted === 0) {
                confirmation = confirm(`Are you sure you want to soft delete the account of the user ${userName}?`);
            } else {
                confirmation = confirm(`Are you sure you want to restore the account of the user ${userName}?`);
            }

            if (confirmation) {
                window.location.href = button.getAttribute('href');
            }
        }
</script>

@endsection
