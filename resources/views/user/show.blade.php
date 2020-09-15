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
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th scope="col">Name</th>
                                <td>
                                    {{ $user->name }}
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary float-right">Update Profile</a>
                                </td>
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
                                <th scope="col">About Me</th>
                                <td>{{ $user->about_me }}</td>
                            </tr>
                            <tr>
                                <th scope="col">Hobbies</th>
                                <td>
                                    @if ($user->hobbies->count()>0)
                                        <ul class="list-group">
                                            @foreach ($user->hobbies as $hobby)
                                                <li class="list-group-item">
                                                    @if (file_exists('img/hobbies/'. $hobby->id. '_thumb.jpg'))
                                                        <a title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">
                                                            <img src="/img/hobbies/{{ $hobby->id }}_thumb.jpg" alt="thumb">
                                                        </a>
                                                    @endif
                                                    <a class="ml-2" title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">{{ $hobby->name }}</a>
                                                    <span class="float-right">{{ $hobby->created_at->diffForHumans() }}</span>
                                                    <br/>
                                                    @foreach ($hobby->tags as $tag)
                                                        <a href="/hobby/tag/{{$tag->id}}">
                                                            <span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                                                        </a>
                                                    @endforeach
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>You have not created any hobby yet</p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    @if (Auth::user() && file_exists('img/users/'.$user->id.'_large.jpg'))
                        <a href="/img/users/{{ $user->id }}_large.jpg" data-lightbox="img/users/{{ $user->id }}_large.jpg" data-title="{{ $user->name }}">
                            <img class="img-fluid" src="/img/users/{{ $user->id }}_large.jpg" alt="{{ $user->name }}">
                        </a>
                    @else
                        <a href="/img/users/{{ $user->id }}_pixelated.jpg" data-lightbox="img/users/{{ $user->id }}_pixelated.jpg" data-title="{{ $user->name }}">
                            <img class="img-fluid" src="/img/users/{{ $user->id }}_pixelated.jpg" alt="{{ $user->name }}">
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
