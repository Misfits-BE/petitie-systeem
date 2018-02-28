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
                        I've got some Laravel packages from @Cartalyst (I have a subscription). I've downloaded the packages as I can't currently install them via Composer for some reason.
                        Is there a way I can integrate them into Laravel manually? I've put the relevant files into vendor/cartalyst but not sure what to do next.
                        Any suggestions would be appreciated. :)
                    </div>
                </div> {{--//Ticket section--}}

                <hr class="comments-border" /> {{-- Start comment listing --}}
                    
                    <div class="panel panel-default ticket-info"> {{-- Comment box --}}
                        <div class="panel-heading">
                            <img src="http://via.placeholder.com/20x20" class="comment-avatar">
                            <strong>Tim Joosten</strong> <small class="text-muted">replied 2 years ago</small>

                            <a href="" class="pull-right text-muted" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>

                        <div class="panel-body">
                            Edit composer.json, edit app.php in /config and then run composer update.
                        </div>
                    </div> {{-- // Comment box --}}

                <hr class="comments-border" /> {{-- END comment listing --}}

                <div class="panel panel-default panel-body">
                    
                </div>

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
                                <tr>
                                    <td><strong>Creator</strong></td>
                                    <td><span class="pull-right">{{ $ticket->author->name }}</span></td>
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
                        
                            <table class="table table-responsive">
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

@push('scripts')
    <script> $(function () { $('[data-toggle="tooltip"]').tooltip() }) </script> 
@endpush