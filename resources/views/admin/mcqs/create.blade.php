@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create questions and options') }}</h5>
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">

        ques

    </div>
</div>

@endsection
