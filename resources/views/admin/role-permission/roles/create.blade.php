@extends('admin.layout.app')

@section('title', 'Create Roles')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Roles') }}</h5>
        <a href="{{ route('admin.role.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.role.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">{{ __('Role Name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" required placeholder="Role Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="guard" class="form-label">Select Authontication Guard</label>
                <select id="guard" name="guard" class="form-select @error('guard') is-invalid @enderror">
                    <option value="">{{ __('---select---') }}</option>
                    @foreach ($guards as $guard)
                        <option value="{{ $guard }}" @if(old('guard') == $guard) selected @endif>{{ $guard }}</option>
                    @endforeach
                </select>
                <div class="form-text text-warning">{{ __('Be careful while selecting guard, Once assigned, it can\'t be changed.') }}</div>
                @error('guard')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-label">{{ __('Assign permission to role') }}</div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-2" id='permission'></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#guard').change(function (e) { 
        e.preventDefault();

        let selctedguard = $(this).find(":selected").val();

        if(selctedguard === 'web' || selctedguard === 'admin'){
            // console.log('pankaj :', selctedguard);

            $.ajax({
                type: "POST",
                url: "{{ route('admin.getpermission') }}",
                data: {"_token": "{{ csrf_token() }}",'guard': selctedguard},
                dataType: "JSON",
                success: function (response) {
                    if(response.data.length !== 0){
                        $('#permission').html('');
                        $('#permission').addClass('row-cols-1 row-cols-md-3 row-cols-lg-6 g-2');
                        var htmlinput = '';
                        $.each(response.data, function (key, value) {
                            htmlinput += '<div class="col"><div class="form-check form-check-inline">';
                            htmlinput +='<input class="form-check-input" type="checkbox" name="permission[]" id="permission'+value.id+'" value="'+value.name+'"><label class="form-check-label" for="permission'+value.id+'">'+value.name+'</label>';
                            // $('#permision').append('<input class="form-check-input" type="checkbox" name="permission[]" id="permission'+value.id+'" value="'+value.name+'"><label class="form-check-label" for="permission'+value.id+'">"'+value.name+'"</label>');
                            htmlinput += '</div></div>';
                        });

                        $('#permission').html(htmlinput);

                    }else{
                        $('#permission').removeClass('row-cols-1 row-cols-md-3 row-cols-lg-6 g-2');
                        $('#permission').html('<p id="nopermission">No Permission found for selected guard.</p>');
                    }
                }
            });
        }
    
    });
</script>

@endsection