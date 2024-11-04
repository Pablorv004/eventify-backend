@extends('layouts.app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                @include('partials.errors')
                @include('partials.messages')

                <div class="mb-4 d-flex justify-content-between" role="group">
                    <button class="btn btn-primary" onclick="showUserList('organizer_events')">Organizer Events (Own)</button>
                    <div>
                        <span class="me-2" style="font-weight: bold">Event Categories</span>
                        <button class="btn btn-primary ms-2" onclick="showUserList('music_events')">Music</button>
                        <button class="btn btn-primary ms-2" onclick="showUserList('unverified')">Tech</button>
                        <button class="btn btn-primary ms-2" onclick="showUserList('unverified')">Sport</button>
                    </div>
                </div>

                <div id="organizer_events_table">
                    @include('partials.events.organizer_events_table')
                </div>

                <div id="music_events_table" style="display: none;">
                    @include('partials.events.music_events_table')
                </div>
                {{-- 
            <div id="unverified_user_table" style="display: none;">
                @include('partials.users.unverified_user_table')
            </div>

            <div id="unverified_user_table" style="display: none;">
                @include('partials.users.unverified_user_table')
            </div> --}}

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showUserList(listType) {
            document.getElementById('organizer_events_table').style.display = 'none';
            document.getElementById('music_events_table').style.display = 'none';
            // document.getElementById('unverified_user_table').style.display = 'none';

            if (listType === 'organizer_events') {
                document.getElementById('organizer_events_table').style.display = 'block';
            } else if (listType === 'music_events') {
                document.getElementById('music_events_table').style.display = 'block';
            } else if (listType === 'unverified') {
                document.getElementById('unverified_user_table').style.display = 'block';
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
