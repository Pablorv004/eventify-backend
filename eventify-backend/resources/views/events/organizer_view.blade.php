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
                        <button class="btn btn-primary ms-2" onclick="showUserList('tech_events')">Tech</button>
                        <button class="btn btn-primary ms-2" onclick="showUserList('sport_events')">Sport</button>
                    </div>
                </div>


                <div id="organizer_events_table">
                    @include('partials.events.organizer_events_table')
                </div>

                <div id="music_events_table" style="display: none;">
                    @include('partials.events.music_events_table')
                </div>

                <div id="tech_events_table" style="display: none;">
                    @include('partials.events.tech_events_table')
                </div>

                <div id="sport_events_table" style="display: none;">
                    @include('partials.events.sport_events_table')
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showUserList(listType) {
            document.getElementById('organizer_events_table').style.display = 'none';
            document.getElementById('music_events_table').style.display = 'none';
            document.getElementById('tech_events_table').style.display = 'none';
            document.getElementById('sport_events_table').style.display = 'none';

            if (listType === 'organizer_events') {
                document.getElementById('organizer_events_table').style.display = 'block';
            } else if (listType === 'music_events') {
                document.getElementById('music_events_table').style.display = 'block';
            } else if (listType === 'tech_events') {
                document.getElementById('tech_events_table').style.display = 'block';
            } else if (listType === 'sport_events') {
                document.getElementById('sport_events_table').style.display = 'block';
            }
        }

        function handleDeleteEvent(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const eventId = button.getAttribute('data-id');
            const eventName = button.getAttribute('data-name');

            let confirmation = confirm(
                `Are you sure you want to delete the event:\n\n ${eventName}?`);

            if (confirmation) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('events.destroy', ['event' => '__eventId__']) }}`.replace('__eventId__', eventId);
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function createNewEvent() {
            let confirmation = confirm('Are you sure you want to create a new event?');

            if (confirmation) {
                window.location.href = `{{ route('events.create') }}`;
            }
        }
    </script>
@endsection
