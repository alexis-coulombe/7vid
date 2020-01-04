<div>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ $total > 0 ? ($upVotes / $total)*100 : 50 }}%;"></div>
    </div>
    <span class="pull-left">{{ $upVotes }}</span>
    <span class="pull-right">{{ $downVotes }}</span>
</div>
