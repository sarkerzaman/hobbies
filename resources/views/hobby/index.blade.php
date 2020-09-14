@extends('layouts.app')

@section('page_title', 'My Hobbies')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @isset($filter)
                    <div class="card-header">{{ __('Filtered hobbies by : ') }}
                        <span style="font-size: 110%" class="badge badge-{{ $filter->style }}">{{ $filter->name }}</span>
                        <span class="float-right"><a href="{{ route('hobby.index') }}">Show all Hobbies</a></span>
                    </div>
                @else
                    <div class="card-header">{{ __('List of Hobbies') }}</div>
                @endisset

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($hobbies as $hobby)
                            <li class="list-group-item">
                                <a title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">
                                    <img src="/img/thumb_landscape.jpg" alt="thumb"> {{ $hobby->name }}
                                </a>
                                <span class="mx-2">Posted by: <a title="User Detail" href="{{ route('user.show', $hobby->user->id) }}">{{ $hobby->user->name }}</a> ({{ $hobby->user->hobbies->count() }} hobbies)</span>
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
                </div>
            </div>

            <div class="mt-3">
                {{ $hobbies->links() }}
            </div>

            @auth
                <div class="mt-2">
                    <a class="btn btn-success" href="{{ route('hobby.create') }}"><i class="fas fa-plus-circle"></i>  New Hobby</a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
