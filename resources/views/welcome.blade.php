@extends('layouts.app')

@section('content')
    <div class="jumbotron margin-top-minus-20">
        <div class="container">
            <h1>{{ config('app.name' )}} - Petitions</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Discover petitions »</a></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-text-o" style="padding-right: 5px;"></i> Trending in <a href="">#test</a>

                        <span class="pull-right">
                            1.000.000 signatures
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-rounded" src="http://via.placeholder.com/100x100" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><strong>Media heading</strong></h4>
                                Media bottom
                            </div>
                        </div>
                    </div>
                </div>

                <a href="" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-fw fa-wpexplorer"></i> Explore more petitions
                </a>

            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">
                            <i class="fa fa-tags"></i> Topics
                        </span>
                    </div>

                    <div class="panel-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection