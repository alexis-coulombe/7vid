@if(Auth::check() && $video->author->id === Auth::id())
    <div class="float-right">
        <a href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>

        <form id="delete" action="{{ route('video.destroy', ['id' => $video->id]) }}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
        </form>

        @include('shared.modals.delete')
    </div>
@endif
