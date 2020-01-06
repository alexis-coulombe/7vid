@if (isset($errors) && $errors->any())
    @foreach ($errors->all() as $error)
        @php $passed[] = $error @endphp
        <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
            {!! html_entity_decode($error) !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif

@if(isset($success))
    <div class="alert alert-success alert-dismissible fade show">
        {!! $success !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
