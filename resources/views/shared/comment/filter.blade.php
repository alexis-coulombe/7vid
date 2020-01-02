<div class="main-title">
    <div class="btn-group float-right right-action">
        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter by <i class="fa fa-caret-down" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item filter_item" href="#" data-value="rated">
                <i class="fas fa-fw fa-star"></i> &nbsp; Top Rated
            </a>
            <a class="dropdown-item filter_item" href="#" data-value="date">
                <i class="fas fa-fw fa-signal"></i> &nbsp; Publish date
            </a>
            <a class="dropdown-item filter_item" href="#" data-value="vote_count">
                <i class="fas fa-vote-yea"></i> &nbsp; Vote count
            </a>
        </div>
    </div>
    <h6>Featured Videos</h6>
</div>

<form method="GET" id="filter_form">
    {{ csrf_field() }}
    <input type="hidden" name="filter_comments" value="" id="filter_value">
</form>
