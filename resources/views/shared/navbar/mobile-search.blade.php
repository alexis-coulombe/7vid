<div class="top-mobile-search">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('video.search') }}" class="mobile-search">
                <div class="input-group">
                    {{ csrf_field() }}

                    <input type="text" name="search" class="form-control" placeholder="Video id, Author, Category ..." required>
                    <div class="input-group-append">
                        <button type="button" aria-label="Search" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
