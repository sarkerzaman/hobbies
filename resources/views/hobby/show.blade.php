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
                    <div class="row">
                        <div class="col-md-9">
                            <h5>{{ $hobby->name }}</h5>
                            <p>{{ $hobby->description }}</p>

                            @if ($hobby->tags->count() > 0)
                                <b>Used Tags:</b> (Click to remove)
                                <p>
                                    @foreach ($hobby->tags as $tag)
                                        <a href="/hobby/{{ $hobby->id }}/tag/{{ $tag->id }}/detach">
                                            <span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                                        </a>
                                    @endforeach
                                </p>
                            @endif

                            @if ($availableTags->count() > 0)
                                <b>Available Tags:</b> (Click to assign)
                                <p>
                                    @foreach ($availableTags as $tag)
                                        <a href="/hobby/{{ $hobby->id }}/tag/{{ $tag->id }}/attach">
                                            <span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span>
                                        </a>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="col-md-3">
                            @if (Auth::user() && file_exists('img/hobbies/'.$hobby->id.'_large.jpg'))
                                <a href="/img/hobbies/{{ $hobby->id }}_large.jpg" data-lightbox="img/hobbies/{{ $hobby->id }}_large.jpg" data-title="{{ $hobby->name }}">
                                    <img class="img-fluid" src="/img/hobbies/{{ $hobby->id }}_large.jpg" alt="Hobby Large Image">
                                </a>
                            @else
                                <a href="/img/hobbies/{{ $hobby->id }}_pixelated.jpg" data-lightbox="img/hobbies/{{ $hobby->id }}_pixelated.jpg" data-title="{{ $hobby->name }}">
                                    <img class="img-fluid" src="/img/hobbies/{{ $hobby->id }}_pixelated.jpg" alt="Hobby Large Image">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="mt-2">
                <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
