@extends('layouts.app')

@section('page_title', 'My Hobbies')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>I'm {{ auth()->user()->name }}</h2>
                            <h5>Motto</h5>
                            <p>{{ auth()->user()->motto ?? '' }}</p>
                            <h5>About Me </h5>
                            <p>{{ auth()->user()->about_me ?? '' }}</p>
                            <a href="{{ route('user.edit', auth()->user()->id) }}" class="btn btn-sm btn-primary float-right">Update Profile</a>
                        </div>
                        <div class="col-md-3">
                            @if (Auth::user() && file_exists('img/users/'.auth()->user()->id.'_large.jpg'))
                                <a href="/img/users/{{ auth()->user()->id }}_large.jpg" data-lightbox="img/users/{{ auth()->user()->id }}_large.jpg" data-title="{{ auth()->user()->name }}">
                                    <img class="img-fluid" src="/img/users/{{ auth()->user()->id }}_large.jpg" alt="{{ auth()->user()->name }}">
                                </a>
                            @else
                                <a href="/img/users/{{ auth()->user()->id }}_pixelated.jpg" data-lightbox="img/users/{{ auth()->user()->id }}_pixelated.jpg" data-title="{{ auth()->user()->name }}">
                                    <img class="img-fluid" src="/img/users/{{ auth()->user()->id }}_pixelated.jpg" alt="{{ auth()->user()->name }}">
                                </a>
                            @endif
                        </div>
                    </div>

                    @if($hobbies)
                        @if ($hobbies->count() > 0)
                            <h5 class="mb-3">Hobbies: </h5>
                        @else
                            <h5 class="mb-3">You have not created any hobby yet.</h5>
                        @endif

                        <ul class="list-group">
                            @foreach ($hobbies as $hobby)
                                <li class="list-group-item">
                                    @if (file_exists('img/hobbies/'. $hobby->id. '_thumb.jpg'))
                                        <a title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">
                                            <img src="/img/hobbies/{{ $hobby->id }}_thumb.jpg" alt="Hobby Thumb">
                                        </a>
                                    @endif
                                <a class="ml-2" title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">{{ $hobby->name }}</a>
                                    @auth
                                        <a class="btn btn-sm btn-light ml-4" href="{{ route('hobby.edit', $hobby->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                        <form style="display:inline" action="{{ route('hobby.destroy', $hobby->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                                        </form>
                                    @endauth
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
                    @endif

                    <a href="{{ route('hobby.create') }}" class="btn btn-sm btn-success mt-3"><i class="fas fa-plus-circle"></i> Create new hobby</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
