<div class="card">
    <div class="card-body">
        <h5 class="card-title text-uppercase mb-0">{{ $category_name }} events</h5>
    </div>
    <div class="table-responsive">
        <table class="table no-wrap user-table mb-0">
            <thead>
                @if ($events->count())
                    <tr>
                        <th scope="col" class="border-0 text-uppercase font-medium pl-4">Image</th>
                        <th scope="col" class="border-0 text-uppercase font-medium pl-4">Event</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Organizer</th>
                        @if ($category_name == 'user')
                            <th scope="col" class="border-0 text-uppercase font-medium">Sign up date</th>
                        @endif
                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                    </tr>
                @endif
            </thead>
            @forelse($events as $event)
                <tbody>
                    <tr>
                        <td class="fw-bold align-content-center">
                            <img src="{{ asset('images/events/' . ($currentCategory == 'user' ? $event->event->image_url : $event->image_url)) }}" alt="user" class="rounded-circle" width="40">
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $currentCategory == 'user' ? $event->event->title : $event->title}}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $currentCategory == 'user' ? $event->event->organizer->name : $event->organizer->name}}</h5>
                        </td>
                        @if ($currentCategory == 'user')
                            <td class="fw-bold align-content-center">
                                <h5>{{ $event->registered_at }}
                                </h5>
                            </td>
                        @endif
                        <td class="fw-bold align-content-center">
                            @if($currentCategory == 'user')
                                <form action="{{ route('user.unregisterEvent', $event->event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                    <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.registerEvent', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                    <i class="fa fa-plus" style="color: #63E6BE;"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                </tbody>
            @empty
                <tbody>
                    <tr class="align-content-center">
                        <td colspan="9" class="text-center">
                            <h3>There are no events to show</h3>
                        </td>
                    </tr>
                </tbody>
            @endforelse
        </table>
    </div>
</div>
