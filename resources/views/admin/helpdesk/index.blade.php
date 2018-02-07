@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12"> {{-- Helpdesk navigation --}}
                @include('shared.helpdesk.navigation')
            </div> {{-- /// END helpdesk navigation --}}

            <div class="col-md-8"> {{-- content --}}
                {{-- /// Content --}}
            </div> {{-- /// Content --}}

        </div>
    </div>
@endsection