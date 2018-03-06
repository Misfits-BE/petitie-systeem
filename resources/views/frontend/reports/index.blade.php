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
                                        <h3>Report petition - {{ ucfirst($petition->title) }} </h3>

                                        <p>
                                            Creating and signing petitions should be safe, so we take abuse and harrasment seriously at 
                                            {{ config('app.name') }} - petitions. We want to hear about harmful behaviour on petitions that 
                                            violates our <a href="">Code Of Conduct</a>. Let us know the name of the user or petition 
                                            you're concerned with. Rest assured, we'll keep your identifying information private to the creator.
                                        </p>

                                        <hr>

                                        <form method="POST" action="" class="form-horizontal">
                                            {{ csrf_field() }} {{-- Form field protection --}}

                                            <div class="form-group">
                                                <label class="control-label col-md-3"> Your name and email: <span class="text-danger">*</span></label>
                                                
                                                <div class="col-md-4">
                                                    <input type="text" placeholder="Your name" class="form-control">
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text" placeholder="Your email adddress" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Subject: <span class="text-danger">*</span></label>

                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option value="">-- Category --</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                     <input type="text" placeholder="Subject" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa fa-fw fa-send"></i> Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="col-md-3">
                                        <div style="margin-top: 40px;">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Contact {{ config('app.name') }} - Petitions
                                                </div>

                                                <div class="list-group">
                                                    <a href="" class="list-group-item">
                                                        <span class="fa fa-fw fa-question"></span> Privacy concerns
                                                    </a>

                                                    <a href="" class="list-group-item {{ isActive('petition/report*') }}">
                                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> Report abuse
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
        </div>
    </div>
@endsection