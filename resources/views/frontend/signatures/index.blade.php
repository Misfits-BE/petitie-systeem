@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session partial --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('shared.petitions.partials.navigation') {{-- Specific petition navigation view partial --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection