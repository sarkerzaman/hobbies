@extends('layouts.app')

@section('page_title', 'My Hobbies')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Hobbies') }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($hobbies as $hobby)
                            <li class="list-group-item">
                                <a title="Hobby Detail" href="{{ route('hobby.show', $hobby->id) }}">{{ $hobby->name }}</a>
                                <a class="btn btn-sm btn-light ml-4" href="{{ route('hobby.edit', $hobby->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                <form class="float-right" style="display:inline" action="{{ route('hobby.destroy', $hobby->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-3">
                {{ $hobbies->links() }}
            </div>
            <div class="mt-2">
                <a class="btn btn-success" href="{{ route('hobby.create') }}"><i class="fas fa-plus-circle"></i>  New Hobby</a>
            </div>
        </div>
    </div>
</div>
@endsection
