@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Questions & Options') }}</h5>

        <a href="{{ route('admin.questionoptions.createquestion', $event_id) }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus"></span>&nbsp; {{__("Add Question")}}
        </a>

        <a href="{{ route('admin.events.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; {{__("Back")}}
        </a>
    </div>

    <div class="card-body">

        <div class="accordion" id="accordionExample">
            @forelse ($question_options as $qo)
                <div class="card accordion-item mb-3">
                    <h2 class="accordion-header" id="heading{{$qo->id}}">
                        <button type="button" class="accordion-button border border-success border-bottom-0 collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$qo->id}}" aria-expanded="false" aria-controls="accordion{{$qo->id}}">
                            <span><span>{{"Qus"}} {{++$i}} <i class='tf-icons bx bx-chevron-right'></i></span> {{$qo->question}}</span>
                        </button>
                    </h2>

                    <div id="accordion{{$qo->id}}" class="accordion-collapse border border-success collapse"  aria-labelledby="heading{{$qo->id}}" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="d-flex justify-content-between">
                                        <span class="text-decoration-underline">{{"Options"}}</span>
                                        <a href="{{ route('admin.questionoptions.edit', $qo->id) }}" class="text-decoration-underline ms-3">{{__("Edit Question")}}</a>

                                        <form action="{{ route('admin.questionoptions.destroy', $qo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span><span class="ms-3">Delete</span></a>
                                        </form>
                                    </span>

                                    <ul class="list-group list-group-flush">
                                        @php
                                            $j = 0;
                                        @endphp
                                        @forelse (json_decode($qo->options) as $item)
                                            @php
                                                ++$j;
                                            @endphp
                                            <li class="list-group-item">{{"Option $j"}}<i class='tf-icons bx bx-chevron-right'></i>{{$item}}</li>
                                        @empty
                                            <li class="list-group-item">{{"No option found"}}</li>
                                        @endforelse
                                        <li class="list-group-item">{{"Correct Option "}}<i class='tf-icons bx bx-chevron-right'></i>{{"Option $qo->correct_option"}}</li>
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                    </div>
                </div>            
            @empty
                <span>{{ __('No record found!') }}</span>
            @endforelse
            {!! $question_options->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

@endsection