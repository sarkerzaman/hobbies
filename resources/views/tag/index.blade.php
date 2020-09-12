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
                                <a class="btn btn-sm btn-light ml-4" href="{{ route('tag.edit', $tag->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                <form class="float-right" style="display:inline" action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-success" href="{{ route('tag.create') }}"><i class="fas fa-plus-circle"></i>  New Tag</a>
            </div>
        </div>
    </div>
</div>
@endsection
