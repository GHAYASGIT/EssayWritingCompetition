@extends('app.layout')

@section('title', 'Essay')

@section('content')

<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Create Your Essay') }}</span></div>
        </div>
    </div>

    <div class="card mb-4">
        <form action="{{ route('essay.store') }}" method="post" id="essay_form">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">{{ $event->name }}</h5>
                <div class="demo-inline-spacing">
                    <button type="submit" onclick="draftInputField()" id="draft" class="btn btn-secondary">{{ __('Save to Draft') }}</button>
                    <button type="submit" onclick="submitInputField()" onclick="return confirm('Are you sure?');" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">{{ __('Write your essay') }}</label>

                    <textarea name="essay_content" class="form-control @error('essay_content') is-invalid @enderror" id="essay_text">
                        @isset($essay->content)
                            @if ($essay->content)
                                {{$essay->content}}
                            @endif
                        @endisset
                    </textarea>
                    @error('essay_content')
                        <p class="invalid-feedback"> {{ $message }} </p>
                    @enderror

                    <div id="defaultFormControlHelp" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('assets/js/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#essay_text' ), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            } )

            .then(editor => {
                // Restrict copy, cut, and paste
                editor.editing.view.document.on('clipboardInput', (evt, data) => {
                    evt.preventDefault(); // Prevent paste
                });

                editor.ui.view.editable.element.addEventListener('cut', (event) => {
                    event.preventDefault(); // Prevent cut
                });

                editor.ui.view.editable.element.addEventListener('copy', (event) => {
                    event.preventDefault(); // Prevent copy
                });
            })            

            .catch( err => {
                console.error( err.stack );
            } );
    </script>
    <script>
        function draftInputField() {
            // Create a new input element
            const newInput = document.createElement("input");
            newInput.type = "hidden";
            newInput.name = `is_drafted`;
            newInput.value = 1;
            newInput.class = "is_drafted_input";

            // Append the new input to the container
            const container = document.getElementById("essay_form");
            container.appendChild(newInput);
        }
        function submitInputField() {
            // Create a new input element
            const newInput = document.createElement("input");
            newInput.type = "hidden";
            newInput.name = `is_drafted`;
            newInput.value = 0;
            newInput.class = "is_drafted_input";

            // Append the new input to the container
            const container = document.getElementById("essay_form");
            container.appendChild(newInput);
        }
    </script>    
@endsection