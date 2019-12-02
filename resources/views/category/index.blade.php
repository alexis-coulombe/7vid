@extends('shared.template')

@section('title')
    category {{ $category->title }}
@endsection

@section('content')
    <h1><i class="{{ $category->icon }}"></i> {{ $category->title }}</h1>
    <div class="top-category section-padding mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" aria-label="filter" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <h5>Videos</h5>
                    </div>
                </div>
                @php $videos = \App\Category::find($category->id)->videos()->paginate(16); @endphp
                @foreach($videos as $video)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        @include('shared.video.card')
                    </div>
                @endforeach
            </div>
            {{ $videos->links() }}
        </div>
    </div>
@endsection
