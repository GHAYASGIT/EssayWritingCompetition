@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>
@dd($questionOptions->event_id);

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create questions and options') }}</h5>
        <a href="{{ route('admin.questionoptions.index', $event_id) }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; {{__("Back")}}
        </a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.questionoptions.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event_id" value="{{$event_id}}">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="mb-3">
                        <label class="form-label" for="question">{{"Enter Question"}}</label>
                        <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" id="question" placeholder="Enter Question">
                        @error('question')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
                    <ul class="list-group list-group-flush dynamic-wrap">
                        <li class="list-group-item entry">
                            <label class="form-label" for="option">{{"Enter Options"}}</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('options') is-invalid @enderror" name="options[]" id="options" placeholder="Enter options">
                                <button class="btn btn-outline-primary btn-add" type="button"><i class='tf-icons bx bx-list-plus'></i></button>
                                @error('options')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="mb-3">
                <label class="form-label" for="correct-option">{{"Enter Correct Option Number"}}</label>
                <input type="number" min="1" class="form-control @error('correct_option') is-invalid @enderror" name="correct_option" value="{{ old('correct_option') }}" id="correct_option" placeholder="Enter Correct Option Number">
                @error('correct_option')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>                               
        </form>



    </div>
</div>

@endsection

@section('script')

<script>
    $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var text = $(this).parents('.entry:first').find('label').html();
            var number = text.match(/\d+/);

            if(number == null){
                var add = 1;
            }else{
                var add = number;
            }

            $(this).parents('.entry:first').find('label').html('Enter Options '+add);

            var dynaForm = $('.dynamic-wrap'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(dynaForm);

            newEntry.find('input').val('');
            var add = ++add;
            newEntry.find('label').html('Enter Options '+add);

            currentEntry.find('button').removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-outline-primary').addClass('btn-outline-danger')
            .html('<i class="tf-icons bx bx-minus"></i>');

            dynaForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-outline-primary').addClass('btn-outline-danger')
            .html('<i class="tf-icons bx bx-minus"></i>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            $('.entry').each(function (index) {
                index = index+1;

                $(this).find('label').html('Enter Options '+index);
            });


            e.preventDefault();
            return false;
        });
    });    
</script>

@endsection
