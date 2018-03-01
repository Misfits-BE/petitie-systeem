@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile settings        
                    </div>
                
                    <div class="list-group">
                        <a href="#information" aria-controls="information" role="tab" data-toggle="tab" class="list-group-item">
                            <i class="fa fa-fw fa-info-circle"></i> Information
                        </a>

                        <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                            <i class="fa fa-fw fa-key"></i> Security
                        </a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-9">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="information">
                        @include('auth.settings.information')
                    </div>

                    <div role="tabpanel" class="tab-pane fade in" id="security">
                        @include('auth.settings.security')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection