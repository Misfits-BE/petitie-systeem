@if ($loop->first) {{-- For the first comment we need a breakline bewteen tickets info and comments --}}
    <hr class="comments-border" /> {{-- Start comment listing --}}
@endif 
                    
<div class="panel panel-default ticket-info"> {{-- Comment box --}}
    <div class="panel-heading">
        <img src="{{ $reaction->author->getMedia('images')->first()->getUrl('thumb-comment') }}" class="comment-avatar" alt="{{ $reaction->author->name }} - avatar">
        <strong><a href="">{{ $reaction->author->name }}</a></strong> 
        <small class="text-muted">replied {{ $reaction->created_at->diffForHumans() }}</small>

        @can ('delete', $reaction) {{-- The authencated user is the comment author and can delete the comment --}}
            <a href="{{ route('comment.delete', $reaction) }}" class="pull-right text-muted" data-toggle="tooltip" data-placement="bottom" title="Delete">
                <i class="fa fa-trash"></i>
            </a> 
        @endcan
    </div>

    <div class="panel-body markdown-correct">{!! markdown($reaction->comment) !!}</div>
</div> {{-- // Comment box --}}