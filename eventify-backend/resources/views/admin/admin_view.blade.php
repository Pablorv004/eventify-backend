@extends('layouts.app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.errors')
                @include('partials.messages')
                @include('partials.users.validated_user_table')
                <br>
                @include('partials.users.unvalidated_user_table')
                <br>
                @include('partials.users.unverified_user_table')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleValidateButton(event) {
            event.preventDefault();

            const button = event.currentTarget;

            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const accountStatus = parseInt(button.getAttribute('data-status'));

            let confirmation = "";
            if (accountStatus == 0) {
                confirmation = confirm(
                    `Are you sure you want to activate the account of the user ${userName}?`
                );
            } else {
                confirmation = confirm(
                    `Are you sure you want to deactivate the account of the user ${userName}?`
                );
            }

            if (confirmation) {
                window.location.href = `/toggleuserstatus/${userId}`;
            }
        }

        function handleDeleteUser(event) {
            event.preventDefault();

            const button = event.currentTarget;

            // Obtain user ID and account status
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');

            let confirmation = confirm(
                `Are you sure you want to delete the account of the user ${userName}?`);

            if (confirmation) {
                window.location.href = `/deleteuser/${userId}`;
            }
        }
    </script>
@endsection
