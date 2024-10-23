<div class="card">
    <div class="card-body">
        <h5 class="card-title text-uppercase mb-0">Email verification pending users</h5>
    </div>
    <div class="table-responsive">
        <table class="table no-wrap user-table mb-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 text-uppercase font-medium pl-4">Image</th>
                    <th scope="col" class="border-0 text-uppercase font-medium pl-4">ID</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Register date</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Role</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Verified</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Activated</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Deleted</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                </tr>
            </thead>
            @forelse($users as $user)
            @if($user->email_confirmed == 0)
                <tbody>
                    <tr>
                        <td> <img class="img-fluid" style="width: 6em"
                                src="{{ asset($user->profile_picture) }}" alt=""> </td>
                        <td class="fw-bold">{{ $user->id }}</td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->name }}</h5>
                        </td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->email }}</h5><br>
                        </td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->created_at }}</h5><br>
                        </td>
                        <td>
                            @if ($user->role == 'a')
                                <h5>Admin</h5>
                            @elseif($user->role == 'u')
                                <h5>User</h5>
                            @else
                                <h5>Organizer</h5>
                            @endif
                        </td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->email_confirmed }}</h5>
                        </td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->activated }}</h5>
                        </td>
                        <td>
                            <h5 class="font-medium mb-0">{{ $user->deleted }}</h5>
                        </td>
                        <td>
                            <button type="button"
                                class="btn btn-outline-info btn-circle btn-lg toggle-status"
                                data-id="{{ $user->id }}" 
                                data-status="{{ $user->activated }}"
                                data-name="{{ $user->name }}"
                                {{ $user->email_confirmed == 0 ? 'disabled' : '' }}>
                                @if($user->email_confirmed == 1)
                                    <i class="fa fa-key" style="color: {{ $user->activated == 0 ? '#26ec18' : '#ec1818' }}"></i>
                                @else
                                    <i class="fa fa-key" style="color: #a2a2a3"></i>
                                @endif
                            </button>

                            @if ($user->deleted == 1)
                                <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle" disabled> 
                                    <i class="fa fa-trash" style="color: #a2a2a3"></i> 
                                </button>
                            @else
                                <a href="{{ route('toggle.softdelete', $user->id) }}"
                                    class="btn btn-outline-info btn-circle btn-lg btn-circle  deleteuser"
                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="btn btn-outline-info btn-circle btn-lg btn-circle  edituser">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endif
            @empty
                <h3> There are no users to show </h3>
            @endforelse
        </table>
    </div>
</div>