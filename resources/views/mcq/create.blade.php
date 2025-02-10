@extends('app.layout')

@section('title', 'MCQs')

@section('content')

<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Start Your Test') }}</span></div>
        </div>
    </div>

    <div class="card mb-4">
        <form action="{{ route('mcqs.store') }}" method="post" id="event_form">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">{{ $event->name }}</h5>
                <div class="demo-inline-spacing">
                    {{-- <button type="submit" onclick="draftInputField()" id="draft" class="btn btn-secondary">{{ __('Save to Draft') }}</button> --}}
                    <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
            <div class="card-body">

                @php
                    $j = 0;
                @endphp
                @foreach ($mcqs as $mcq)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <input type="hidden" name="question[{{$mcq->id}}]" value="{{ $mcq->id }}">
                            {{++$j}} <i class="tf-icons bx bx-chevron-right"></i>{{$mcq->question}}
                            <ul class="list-group list-group-flush">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach (json_decode($mcq->options) as $item)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-3" type="radio" name="question[{{$mcq->id}}][option]" value="{{++$i}}">
                                        {{$i}} <i class="tf-icons bx bx-chevron-right"></i>{{$item}}
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                @endforeach

            </div>
        </form>
    </div>
</div>

@endsection