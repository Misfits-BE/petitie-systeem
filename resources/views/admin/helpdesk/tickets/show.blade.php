@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="row">
            <div class="col-md-8"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-fw fa-file-text-o"></i> {{ $ticket->title }}</strong>

                        <a href="" class="pull-right text-muted" data-toggle="tooltip" data-placement="bottom" title="Edit ticket">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>

                    <div class="panel-body">
                    </div>
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

                    </div>
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

                <a href="" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-fw fa-times-circle" aria-hidden="true"></i> Close ticket
                </a>

            </div> {{-- /END sidenav --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script> $(function () { $('[data-toggle="tooltip"]').tooltip() }) </script> 
@endpush