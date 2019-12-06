@if(Auth::check() && $video->author->id === Auth::id())
        <button class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">
            <i class="fas fa-trash"></i> Delete this video
        </button>

        <form id="delete" action="{{ route('video.destroy', ['video' => $video->id]) }}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
        </form>

        @include('shared.modals.delete')
@endif
