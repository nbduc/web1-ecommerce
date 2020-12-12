@extends('admin.layouts.base')

@section('title')
    User Management | Admin {{ config('app.name') }}
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ __('Users') }}
        </div>
        <div class="card-body">
            <div class="row"> 
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary m-2">Create new user</a>
            </div>
            <br>
            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Email verified at</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at }}</td>
                            <td>
                                <a href="{{ url('/users/' . $user->id) }}"
                                    class="btn btn-block btn-primary" role="button">View</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-block btn-primary" role="button">Edit</a>
                            </td>
                            <td>
                                @if ($you->id !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-block btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
