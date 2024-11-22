</html>
<!DOCTYPE html>
<html>

<head>
    <title>Event Attendees Report</title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px 20px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Event Attendees Report</h1>
    <div>
        <table>
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
                            <img src="{{ public_path('images/events/' . $eventAttendee->event->image_url) }}" alt="user"
                                class="rounded-circle" width="40">
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