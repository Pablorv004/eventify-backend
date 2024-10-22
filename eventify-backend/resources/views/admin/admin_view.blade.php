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
                                            <a href="{{ route('toggle.userstatus', $user->id) }}" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                                <i class="fa fa-key"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ms-2"><i class="fa fa-trash"></i> </button>
                                            <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ms-2"><i class="fa fa-edit"></i> </button>   
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
