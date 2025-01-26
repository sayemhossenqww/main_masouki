@extends('admin.layouts.app')
@section('title', 'User Manager')
@section('page_name', 'User Manager')

@section('content')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-3">
                <a class="btn btn-primary px-4 ms-auto" href="{{ route('admin.users.create') }}">Create New User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td><a class="link-primary" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        onSubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0 text-danger">Delete</button>
                                    </form>
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
