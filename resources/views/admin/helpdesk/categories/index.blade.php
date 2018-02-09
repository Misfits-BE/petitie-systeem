@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">

            <div class="col-md-12"> {{-- Helpdesk navigation --}}
                @include('shared.helpdesk.navigation')
            </div> {{-- /// END helpdesk navigation --}}

            <div class="col-md-9"> {{-- content --}}
                <div class="panel panel-default panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed @if (count($categories) > 0) table-hover @endif">
                            <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-2">Name:</th>
                                    <th class="col-md-8" colspan="2">Description:</th> {{-- Colspan="2" needed for the functions --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) > 0) {{-- There are categories found --}}
                                    @foreach ($categories as $category) {{-- Category loop --}}
                                        <tr>
                                            <td><code>#C{{ $category->id }}</code></td>
                                            <td><span style="color: {{ $category->color }}">{{ $category->name }}</span></td>
                                            <td>{{ $category->description }}</td>
                                            <td> {{-- Options --}}
                                                <span class="pull-right">
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('admin.helpdesk.categories.delete', $category) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </span>
                                            </td> {{-- /// End options --}}
                                        </tr>
                                    @endforeach {{-- /// End category loop --}}
                                @else {{-- There are no categories found --}}
                                    <tr>
                                        <td colspan="4" class="text-muted"><i>(There are no helpdesk categories found)</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $categories->links() }}
                </div>
            </div> {{-- /// Content --}}

            <div class="col-md-3">
                @include('shared.helpdesk.category-sidebar')
            </div>

        </div>
    </div>
@endsection