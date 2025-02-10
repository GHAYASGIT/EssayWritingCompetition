@extends('app.layout')

@section('title', 'Submitted Mcqs')

@section('content')

<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Your Submitted mcqs') }}</span></div>
        </div>
    </div>

    <div class="card mb-4">
        @php
            $j = 0;
        @endphp
        @foreach ($data as $item)
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    {{__('Qus '). ++$j}} <i class="tf-icons bx bx-chevron-right"></i>{{$item['qus']}}
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            {{__('Choosen value')}} <i class="tf-icons bx bx-chevron-right"></i>{{$item['option']}}
                        </li>
                    </ul>
                </li>
            </ul>
        @endforeach

    </div>
</div>

@endsection