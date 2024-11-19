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
                            <img src="{{ asset('images/events/' . $event->image_url) }}" alt="user"
                                class="rounded-circle" width="40">
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->title }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->organizer->name }}</h5>
                        </td>
                        @if ($category_name == 'user')
                            <td class="fw-bold align-content-center">
                                <h5>{{ $event->registered_at }}
                                </h5>
                            </td>
                        @endif
                        <td class="fw-bold align-content-center">
                            @if($category_name == 'user')
                                <!-- TODO: IMPLEMENT CONTROLLER FUNCTIONS FOR REGISTERING THE USER TO AN EVENT -->
                                <a href="#"
                                    class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                    <i class="fa-solid fa-user-minus"></i>
                                </a>
                            @else
                                <!-- TODO: IMPLEMENT CONTROLLER FUNCTIONS FOR UNREGISTERING THE USER FROM AN EVENT -->
                                <a href="#"
                                    class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                    <i class="fa-solid fa-check" style="color: #63E6BE;"></i>
                                </a>
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
    {{-- <div class="mt-3 me-3 ms-3">
        @if ($events->count())
            {{ $events->appends(['category' => strtolower($category_name)])->links() }}
        @endif
    </div> --}}
</div>
