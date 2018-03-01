@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="row">
            <div class="col-md-8"> {{-- Content --}}
                <div class="panel panel-default ticket-info"> {{-- Ticket section --}}
                    <div class="panel-heading">
                        <strong><i class="fa fa-fw fa-file-text-o"></i> {{ $ticket->title }}</strong>

                        @can ('update', $ticket) {{-- user is authorizated to edit the ticket --}}
                            <a href="" class="pull-right text-muted" data-toggle="tooltip" data-placement="bottom" title="Edit ticket">
                                <i class="fa fa-pencil"></i>
                            </a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        I've got some Laravel packages from Composer. I've downloaded the packages as I can't currently install them via Composer for some reason.
                        Is there a way I can integrate them into Laravel manually? I've put the relevant files into vendor/cartalyst but not sure what to do next.
                        Any suggestions would be appreciated. :)
                    </div>
                </div> {{--//Ticket section--}}

                @foreach ($ticket->comments as $reaction) {{-- Loop through the ticket comments --}} 
                    @include('shared.comments.helpdesk.listing', $reaction) {{-- Comment partial that will be outputted for each comment --}}
                @endforeach {{-- /// Comments loop --}}

                <hr class="comments-border" /> {{-- END comment listing --}}

                <form class="form-horizontal" method="POST" action="{{ route('comment.store', ['slug' => $ticket->slug]) }}"> {{-- Reply form --}}
                    {{ csrf_field() }} {{-- Form field protection --}}

                    <textarea @input('comment') class="form-control wysiwyg" data-provide="markdown" rows="5">{{ old('comment') }}</textarea>
                    @error('comment', '<span class="help-block text-danger"><span class="text-danger">:message</span></span>') {{-- Validation error view partial --}}

                    <button type="submit" class="btn btn-sm btn-reply btn-success">Reply</button>
                </form> {{-- // Reply form --}}

            </div> {{-- /End content --}}

            <div class="col-md-4"> {{-- Sidenav --}}
                <div class="panel panel-default panel-body"> {{-- Ticket data --}}
                    <div class="table-responsive">
                        
                        <table class="table table-condensed">
                            <thead>
                                <tr><th colspan="2"><span class="pull-right text-muted">Ticket details</span></th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Ticket ID</strong></td>
                                    <td><span class="pull-right"><code>#{{ $ticket->id }}</code></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @if ($ticket->is_open) {{-- Ticket is open --}}
                                            <span class="text-success pull-right">Open</span>
                                        @else {{-- Ticket is closed --}}
                                            <span class="text-danger pull-right">Closed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr @if ($ticket->author->isBanned()) class="danger" @endif>
                                    <td><strong>Creator</strong></td>
                                    <td>
                                        <span class="pull-right">
                                            @if ($ticket->author->isBanned())
                                                <i data-toggle="tooltip" data-placement="bottom" title="Blocked user" class="text-danger fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> 
                                            @endif 
                                            
                                            {{ $ticket->author->name }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Category</strong></td>
                                    <td><span class="pull-right">{{ $ticket->category->name }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Opening date</strong></td>
                                    <td><span class="pull-right">{{ $ticket->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div> {{-- ///Table-response --}}
                </div> {{-- /End Ticket data --}}

                @if ($user->hasRole('admin'))
                    <div class="panel panel-default panel-body"> {{-- Additional ticket data --}}
                        <div class="table-responsive">
                        
                            <table class="table table-condensed">
                                <thead>
                                    <tr><th colspan="2"><span class="pull-right text-muted">Additional data</span></th></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Assignee</strong></td>
                                        <td><span class="pull-right">{!! $ticket->assignee->name !!}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last updated</strong></td>
                                        <td><span class="pull-right">{{ $ticket->updated_at }}</span></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endif

                @if ($ticket->is_open) {{-- Ticket is open --}}
                    <a href="{{ route('admin.helpdesk.tickets.status', ['slug' => $ticket->slug, 'status' => 'close']) }}" class="btn btn-primary btn-lg btn-block">
                        <i class="fa fa-fw fa-times-circle" aria-hidden="true"></i> Close ticket
                    </a>
                @else {{-- Ticket is closed --}}
                    <a href="{{ route('admin.helpdesk.tickets.status', ['slug' => $ticket->slug, 'status' => 'reopen']) }}" class="btn btn-lg btn-primary btn-block">
                        <i class="fa fa-fw fa-check"></i> Reopen ticket
                    </a>
                @endif

            </div> {{-- /END sidenav --}}
        </div>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-markdown.min.css') }}"></link>
@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap-markdown.js') }}"></script>
    <script> $(function () { $('[data-toggle="tooltip"]').tooltip() }) </script> 
@endpush