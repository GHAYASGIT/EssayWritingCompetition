@extends('admin.layout.app')

@section('title', 'Create Events')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Events') }}</h5>
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="event_image" class="form-label">Image</label>
                <input class="form-control @error('event_image') is-invalid @enderror" type="file" id="event_image" name='event_image'>
                @error('event_image')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="name">Title</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Event Title">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-select @error('category_id') is-invalid @enderror" onchange="showMcqs(this)">
                    <option value="">{{ __('---Select Category---') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <div class="mt-3 clear-both text-end">
                    <button type="button" class="btn btn-primary" onclick="createQuestions(this)" id="create_questions">Create Questions</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal create_questions fade" id="modalCenter" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">{{ _('Create questions and there respective options') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="question">Question</label>
                                    <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" id="question" placeholder="Enter Question">
                                    {{-- <button class="btn btn-outline-primary" type="button"><i class='tf-icons bx bx-list-plus'></i></button> --}}
                                    @error('question')
                                        <p class="invalid-feedback"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="entry">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('options') is-invalid @enderror" name="options[]" value="{{ old('options') }}" id="options" placeholder="Enter options">
                                        <button class="btn btn-outline-primary btn-add" type="button"><i class='tf-icons bx bx-list-plus'></i></button>
                                        @error('options')
                                            <p class="invalid-feedback"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 dynamic-wrap"></div>
                                <div class="mb-3 text-end">
                                    <button type="button" onclick="submitQuestion(this)" class="btn btn-primary">Submit</button>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal END -->

            @section('script')
                <script>
                    function showMcqs(elem) {
                        if(elem.selectedIndex == 2) {
                            $('.show-hide').removeClass('d-none');
                            $('.show-hide').addClass('d-block');
                        }else{
                            $('.show-hide').removeClass('d-block');
                            $('.show-hide').addClass('d-none');
                        }
                    }

                    function createQuestions(){
                        const modal = new bootstrap.Modal($('.create_questions'));
                        modal.show();
                    }

                    $(function() {
                        var count = 0;
                        $(document).on('click', '.btn-add', function(e) {
                            e.preventDefault();

                            var add = count++;
                            $(this).parents('.entry:first').addClass('count'+add)

                            if(count < 5){
                                var dynaForm = $('.dynamic-wrap'),
                                currentEntry = $(this).parents('.entry:first'),
                                newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                                var remove = add--;
                                newEntry.find('input').val('').addClass('count'+count).removeClass('count'+remove);
                                currentEntry.find('button').removeClass('btn-add').addClass('btn-remove')
                                .removeClass('btn-outline-primary').addClass('btn-outline-danger')
                                .html('<i class="tf-icons bx bx-minus"></i>');

                                dynaForm.find('.entry:not(:last) .btn-add')
                                .removeClass('btn-add').addClass('btn-remove')
                                .removeClass('btn-outline-primary').addClass('btn-outline-danger')
                                .html('<i class="tf-icons bx bx-minus"></i>');
                            }
                        }).on('click', '.btn-remove', function(e) {
                            $(this).parents('.entry:first').remove();

                            e.preventDefault();
                            return false;
                        });
                    });
                    
                    function submitQuestion(){
                        let question = $('#question').val();

                        console.log('question : ', question);
                        

                        let options = [];
                        $("input[name='options[]']").each(function() {
                            options.push($(this).val());
                        });                        
                        
                        options = JSON.stringify(options);

                        let formData = new FormData();
                        formData.append('question', question);
                        formData.append('option', options);
                        formData.append('event_id', '1');
                        formData.append('_token', "{{ csrf_token() }}")

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.questionoptions.store') }}",
                            data: formData,
                            processData: false, // Required for FormData
                            contentType: false, // Required for FormData
                            success: function (response) {
                                console.log(response);
                            }
                        });                        
                    }
                </script>

            @endsection

            <div class="mb-3">
                <label for="started_at" class="form-label">Start Date Time</label>
                <input class="form-control @error('started_at') is-invalid @enderror" min="{{ now()->subMonths(5)->format('Y-m-d\TH:i') }}" max="{{ now()->addMonths(5)->format('Y-m-d\TH:i') }}" type="datetime-local" name="started_at" value="{{ old('started_at') }}" id="started_at"/>
                @error('started_at')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_at" class="form-label">End Date Time</label>
                <input class="form-control @error('end_at') is-invalid @enderror" min="{{ now()->subMonths(5)->format('Y-m-d\TH:i') }}" max="{{ now()->addMonths(5)->format('Y-m-d\TH:i') }}" type="datetime-local" name="end_at" value="{{ old('end_at') }}" id="end_at"/>
                @error('end_at')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-lable d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="active" value="active">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="inactive" value="inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
                @error('status')
                    <p class="invalid-feedback d-block"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="subscribers">Total Subscribers</label>
                <input type="number" class="form-control @error('subscribers') is-invalid @enderror" name="subscribers" value="{{ old('subscribers') }}" min="1" id="subscribers" placeholder="Total Subscribers">
                @error('subscribers')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>

@endsection
