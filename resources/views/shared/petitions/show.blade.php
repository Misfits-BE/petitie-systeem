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
                                    <div class="col-md-9">
                                        <h3>{{ ucfirst($petition->title) }}</h3> 

                                        <p><strong>This petition will be deliverd to {{ $petition->decision_maker }}</strong></p>
                                        
                                        {!! markdown($petition->text) !!}
                                        
                                        <hr> 
                                        
                                        <form method="POST" action="{{ route('petition.sign', ['slug' => $petition->slug]) }}" class="form-horizontal">
                                            {{ csrf_field() }} {{-- Form field protection --}}

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Your name: <span class="text-danger">*</span></label>

                                                <div class="col-md-4 @error('firstname', 'has-error')">
                                                    <input type="text" class="form-control" @input('firstname', optional(auth()->user())->firstname) placeholder="Firstname">
                                                </div>

                                                <div class="col-md-5 @error('lastname', 'has-error')">
                                                    <input type="text" class="form-control" @input('lastname', optional(auth()->user())->lastname) placeholder="Lastname">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Your email address: <span class="text-danger">*</span></label>

                                                <div class="col-md-9 @error('email', 'has-error')">
                                                    <input type="email" class="form-control" @input('email', optional(auth()->user())->email) placeholder="Your email address">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Your location: <span class="text-danger">*</span></label>

                                                <div class="col-md-4 @error('city', 'has-error')">
                                                    <input type="text" class="form-control" @input('city', optional(auth()->user())->city) placeholder="Postal - City">
                                                </div>

                                                <div class="col-md-5 @error('country_id', 'has-error')">
                                                    <select class="form-control" @input('country_id')>
                                                        <option value="">-- Select your country</option>

                                                        @foreach ($countries as $country) {{-- Loop through countries --}}
                                                            <option value="{{ $country->id }}" @if (optional(auth()->user())->country_id === $country->id) selected @endif>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa fa-fw fa-pencil"></i> Sign
                                                    </button>

                                                    <button type="reset" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-fw fa-undo"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        
                                    <div class="col-md-3">
                                        <div class="counter-margin">
                                            <div class="panel panel-default counter-panel">
                                                <div class="panel-body counter-margin-body">
                                                    <h4 class="counter-title"><strong>{{ $signatureCount }}</strong></h4> 
                                                    <span class="text-muted">Signatures</span>
                                                </div>
                                            </div> 

                                            <hr class="petition-hr-seperator"> 
                                            
                                            <a href="{{ $share['facebook'] }}" class="btn btn-block btn-social btn-facebook">
                                                <span class="fa fa-facebook"></span> Share on facebook
                                            </a> 
                                            
                                            <a href="{{ $share['twitter'] }}" class="btn btn-block btn-social btn-twitter">
                                                <span class="fa fa-twitter"></span> Share on Twitter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection