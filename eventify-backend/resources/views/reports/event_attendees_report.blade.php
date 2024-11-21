<!DOCTYPE html>
<html>

<head>
    <style>
        .centered-table {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .centered-title {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="centered-title">Event Attendees Report</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered centered-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Organizer</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $eventAttendee)
                    <tr>
                        <td>
                            <img src="{{ public_path('images/events/' . $eventAttendee->event->image_url) }}"
                                alt="user" class="rounded-circle" width="40">
                        </td>
                        <td>{{ $eventAttendee->event->title }}</td>
                        <td>{{ $eventAttendee->event->organizer->name }}</td>
                        <td>{{ $eventAttendee->event->start_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
