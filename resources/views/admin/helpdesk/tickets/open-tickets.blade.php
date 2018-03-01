@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-12"> {{-- Helpdesk navigation --}}
                @include('shared.helpdesk.navigation')
            </div> {{-- // END helpdesk navigation --}}

            <div class="col-md-9"> {{-- content --}}
                <div class="panel panel-default panel-body">
                    <div class="table-responsive">
                    
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Issuer:</th>
                                    <th>Title:</th>
                                    <th colspan="2">Created:</th> {{-- Colspan="2" needed for the functions --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tickets) > 0) {{-- There are tickets found --}}
                                    @foreach ($tickets as $ticket) {{-- Loop through the opened tickets --}} 
                                        <tr>
                                            <td><strong>#{{ $ticket->id }}</strong></td>
                                            <td>{{ $ticket->author->name }}</td>
                                            <td><a href="{{ route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]) }}">{{ $ticket->title }}</a></td>
                                            <td>{{ $ticket->created_at->format('m/d/Y') }}</td>

                                            <td> {{-- Options --}}
                                                <span class="pull-right">
                                                    <a href="{{ route('admin.helpdesk.tickets.show', ['slug' => $ticket->slug]) }}" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Show ticket">
                                                        <i class="fa fa-fw fa-info-circle"></i>
                                                    </a>

                                                    <a href="" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Close ticket">
                                                        <i class="fa fa-fw fa-check"></i>
                                                    </a>
                                                </span>
                                            </td> {{-- /Options --}}
                                        </tr>   
                                    @endforeach {{-- // END tickets --}}
                                @else {{-- No tickets found --}}
                                    <tr>
                                        <td colspan="5" class="text-muted">(No opened tickets found)</td>
                                    </tr>
                                @endif 
                            </tbody>
                        </table>

                    </div>

                    {{ $tickets->render() }} {{-- pagination view instance --}}
                </div>
            </div> {{-- // End content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="well well-sm"> {{-- Search box --}}
                    <form method="GET" action="{{ $searchUrl }}">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Zoek ticket">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- /END search box --}}
                
                <div class="list-group"> {{-- Option groups --}}
                    <a href="" class="list-group-item">
                        <i class="fa fa-fw fa-plus"></i> Create new ticket
                    </a>
                </div> {{-- /Option groups --}}
            </div> {{-- /End sidebar --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script> $(function () { $('[data-toggle="tooltip"]').tooltip() }) </script> 
@endpush