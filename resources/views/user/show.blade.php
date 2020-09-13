@extends('layouts.app')

@section('page_title', 'User Detail')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="page-title">
                <h4>{{ __('User Detail') }}</h4>
            </div>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th scope="col">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Moto</th>
                        <td>{{ $user->motto }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Hobbies</th>
                        <td>
                            @foreach ($user->hobbies as $hobby)
                            <a href="{{ route('hobby.show', $hobby->id) }}">
                                <span>{{ $hobby->name }}</span>
                            </a>
                             @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">About Me</th>
                        <td>{{ $user->about_me }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
