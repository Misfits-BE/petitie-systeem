@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session partial --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul role="tablist" class="nav nav-tabs">
                            <li role="presentation" class="active">
                                <a href="">
                                    <i class="fa fa-file-text-o"></i> Petition text
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-pencil"></i> Signatures ({{ $signatureCount }})
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-envelope"></i> Contact creator
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" id="home" class="tab-pane petition-margin-top fade in active">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>{{ $petition->title }}</h3> 

                                        <p><strong>This petition will be deliverd to {{ $petition->decision_maker }}</strong></p>
                                        
                                        {!! markdown($petition->text) !!}
                                        
                                        <hr> 
                                        
                                        <form method="POST" action="" class="form-horizontal">
                                            
                                        </form>
                                    </div>
                                        
                                    <div class="col-md-3">
                                        <div class="counter-margin">
                                            <div class="panel panel-default counter-panel">
                                                <div class="panel-body counter-margin-body">
                                                    <h4 class="counter-title"><strong>{{ $signatureCount }}</strong></h4> 
                                                    <span class="text-muted">Handtekeningen</span>
                                                </div>
                                            </div> 

                                            <hr class="petition-hr-seperator"> 
                                            
                                            <a href="" class="btn btn-block btn-social btn-facebook">
                                                <span class="fa fa-facebook"></span> Deel op facebook
                                            </a> 
                                            
                                            <a href="" class="btn btn-block btn-social btn-twitter">
                                                <span class="fa fa-twitter"></span> Deel op Twitter
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