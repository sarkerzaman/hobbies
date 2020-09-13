@extends('layouts.app')

@section('page_title', 'My Hobbies')
@section('page_description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Hobby Detail') }}</div>

                <div class="card-body">
                    <h5>{{ $hobby->name }}</h5>
                    <p>{{ $hobby->description }}</p>
                    <p>
                        @foreach ($hobby->tags as $tag)
                            <a href="{{ route('tag.index')}}">
                                <span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
