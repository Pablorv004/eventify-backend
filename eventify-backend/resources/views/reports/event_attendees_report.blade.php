<div class="container">
    <h1>Event Attendees Report</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Organizer</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>
                        <img src="{{ asset('images/events/' . $event->image_url) }}" alt="user" class="rounded-circle"
                            width="40">
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->organizer->name }}</td>
                    <td>{{ $event->start_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>