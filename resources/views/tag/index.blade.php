@extends('layouts.app')

@section('page_title', 'Tag List')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Tags') }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tags as $tag)
                            <li class="list-group-item">
                                <span style="font-size: 130%;" class="mr-2 badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                                @auth
                                    @can('update', $tag)
                                        <a class="btn btn-sm btn-light ml-4" href="{{ route('tag.edit', $tag->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                    @endcan

                                    @can('delete', $tag)
                                        <form class="ml-2" style="display:inline" action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                                        </form>
                                    @endcan
                                    <a class="float-right" href="/hobby/tag/{{ $tag->id }}">Used {{ $tag->hobbies->count() }} times</a>
                                @endauth
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @auth
                @can('create', $tag)
                    <div class="mt-2">
                        <a class="btn btn-success" href="{{ route('tag.create') }}"><i class="fas fa-plus-circle"></i>  New Tag</a>
                    </div>
                @endcan
            @endauth
        </div>
    </div>
</div>
@endsection
