@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group">
                    <a href="#unread" aria-controls="unread" role="tab" data-toggle="tab" class="list-group-item">
                        <span class="fa fa-fw fa-bell-o"></span> Unread notifications
                    </a>

                    @if ($user->unreadNotifications->count() > 0)
                        <a href="" class="list-group-item">
                            <span class="fa fa-fw fa-check"></span> Mark all as read
                        </a> 
                    @endif
                </div>
            </div> {{-- /// END sidebar --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="unread"> {{-- Unread notifications tab --}}
                        @include('shared.notifications.partials.unread') {{-- Unread notification partial --}}
                    </div> {{-- /// Unread notifications tab --}}
                </div>
            </div> {{-- /// Content --}}
        </div>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.css">
@endpush