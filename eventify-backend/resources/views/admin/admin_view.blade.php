@extends('layouts.app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.errors')
                @include('partials.messages')

                <!-- Buttons to switch between the user lists -->
                <div class="mb-4" role="group">
                    <button class="btn btn-primary" onclick="showUserList('validated')">Validated Users</button>
                    <button class="btn btn-warning ms-2" onclick="showUserList('unvalidated')">Unvalidated Users</button>
                    <button class="btn btn-danger ms-2" onclick="showUserList('unverified')">Unverified Users</button>
                </div>

                <div id="validated_user_table">
                    @include('partials.users.validated_user_table')
                </div>

                <div id="unvalidated_user_table" style="display: none;">
                    @include('partials.users.unvalidated_user_table')
                </div>

                <div id="unverified_user_table" style="display: none;">
                    @include('partials.users.unverified_user_table')
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showUserList(listType) {
            document.getElementById('validated_user_table').style.display = 'none';
            document.getElementById('unvalidated_user_table').style.display = 'none';
            document.getElementById('unverified_user_table').style.display = 'none';

            if (listType === 'validated') {
                document.getElementById('validated_user_table').style.display = 'block';
            } else if (listType === 'unvalidated') {
                document.getElementById('unvalidated_user_table').style.display = 'block';
            } else if (listType === 'unverified') {
                document.getElementById('unverified_user_table').style.display = 'block';
            }
        }

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
