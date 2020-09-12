@extends('layouts.app')

@section('page_title', 'This is the contact page')
@section('page_description', 'Please contact us for any help')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact Us') }}</div>
                <div class="card-body">
                    This is a sample contact page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
