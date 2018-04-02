@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session partial --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('shared.petitions.partials.navigation') {{-- Specific petition navigation view partial --}}

                        <div class="tab-content">
                            <div role="tabpanel" id="home" class="tab-pane petition-margin-top fade in active">
                                <div class="row">
                                    <div class="col-md-12"> {{-- Signature content --}}
                                        <div class="table-responsive">
                                            <table class="table table-condensed table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Naam:</th>
                                                        <th>Land:</th>
                                                        <th>Plaats:</th>
                                                        <th>Datum:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($signatures) > 0) {{-- There are signatures found --}}
                                                        @foreach ($signatures as $signature) {{-- Signature loop --}}
                                                            <tr>
                                                                <td><strong>#{{ $signature->id }}</strong></td>
                                                                <td>{{ $signature->firstname }} {{ $signature->lastname }}</td>
                                                                <td>{{ $signature->country->name}}</td>
                                                                <td>{{ $signature->city }}</td>
                                                                <td>{{ $signature->created_at->format('m/d/Y H:i')}}</td>
                                                            </tr>   
                                                        @endforeach {{-- /// End signature loop --}}                                                 
                                                    @else {{-- No signatures are found  --}}
                                                        <tr>
                                                            <td colspan="5"><span class="text-muted">There are no signatures for this petition.</span></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        {{ $signatures->links() }} {{-- Pagination view instance --}}
                                    </div> {{-- /// Signature content --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection