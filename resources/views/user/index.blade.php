@extends('layouts.app')

@section('page_title', 'User List')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Users') }}</div>

                <div class="card-body" style="padding-bottom: 0rem">
                    <table class="table table-striped table-responsive">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Moto</th>
                            <th scope="col">Hobbies</th>
                            <th scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td><a title="User Detail" href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->motto }}</td>
                                    <td class="text-center">{{ $user->Hobbies->count() }}</td>
                                    <td>
                                        @auth
                                            <a class="btn btn-sm btn-light ml-4" href="{{ route('user.edit', $user->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                            <form style="display:inline" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                                            </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <caption>{{ $users->links() }}</caption>
                    </table>
                </div>
            </div>
            @auth
                <div class="mt-2 float-right">
                    <a class="btn btn-success" href="{{ route('user.create') }}"><i class="fas fa-plus-circle"></i>  New User</a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
