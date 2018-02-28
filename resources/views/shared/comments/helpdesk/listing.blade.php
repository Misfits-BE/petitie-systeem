@if ($loop->first) {{-- For the first comment we need a breakline bewteen tickets info and comments --}}
    <hr class="comments-border" /> {{-- Start comment listing --}}
@endif 
                    
<div class="panel panel-default ticket-info"> {{-- Comment box --}}
    <div class="panel-heading">
        <img src="http://via.placeholder.com/20x20" class="comment-avatar" alt="{{ $reaction->author->name }} - avatar">
        <strong>{{ $reaction->author->name }}</strong> 
        <small class="text-muted">replied {{ $reaction->created_at->diffForHumans() }}}</small>

        <a href="" class="pull-right text-muted" data-toggle="tooltip" data-placement="bottom" title="Delete">
            <i class="fa fa-trash"></i>
        </a>
    </div>

    <div class="panel-body">{{ $reaction->comment }}</div>
</div> {{-- // Comment box --}}