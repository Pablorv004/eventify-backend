@extends('layouts.app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include("partials.errors")
                @include("partials.messages")
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
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
                                <tbody>
                                    <tr>
                                        <td> <img class="img-fluid" style="width: 50%;" src="{{ asset($user->profile_picture) }}" alt=""> </td>
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
                                            <a href="{{ route('toggle.userstatus', $user->id) }}"
                                                class="btn btn-outline-info btn-circle btn-lg btn-circle  toggle-status" data-id="{{ $user->id }}" data-status="{{ $user->activated }}" data-name="{{ $user->name }}">
                                                <i class="fa fa-key" style="color: {{ $user->activated == 0 ? '#26ec18' : '#ec1818' }}"></i>
                                            </a>
                                            <a href="{{ route('deleteuser', $user->id) }}"
                                                class="btn btn-outline-info btn-circle btn-lg btn-circle  deleteuser" data-id="{{ $user->id }}" data-deleted="{{ $user->deleted }}" data-name="{{ $user->name }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-edit"></i> </button>   
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <h3> There are no users to show </h3>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-status').forEach(button => {
            button.addEventListener('click', function (event) {
                // Prevent default action of the button (Activate directly without waiting for confirmation)
                event.preventDefault();

                // Obtain user ID and account status
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const accountStatus = parseInt(this.getAttribute('data-status'));

                let confirmation = "";
                if (accountStatus == 0) {
                    confirmation = confirm(`Are you sure you want to activate the account of the user ${userName}?`);
                } else {
                    confirmation = confirm(`Are you sure you want to deactivate the account of the user ${userName}?`);
                }

                if (confirmation) {
                    window.location.href = this.getAttribute('href');
                }
            });
        });
    });
</script>
@endsection
