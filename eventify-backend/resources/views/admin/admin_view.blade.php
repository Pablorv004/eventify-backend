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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-status').forEach(button => {
                button.addEventListener('click', function(event) {
                    // Prevent default action of the button (Activate directly without waiting for confirmation)
                    event.preventDefault();

                    // Obtain user ID and account status
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    const accountStatus = parseInt(this.getAttribute('data-status'));

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
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.deleteuser').forEach(button => {
                button.addEventListener('click', function(event) {
                    // Prevent default action of the button (Activate directly without waiting for confirmation)
                    event.preventDefault();

                    // Obtain user ID and account status
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');

                    let confirmation = confirm(
                        `Are you sure you want to delete the account of the user ${userName}?`);

                    if (confirmation) {
                        window.location.href = this.getAttribute('href');
                    }
                });
            });
        });
    </script>
@endsection
