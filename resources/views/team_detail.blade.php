@extends('layout.app')

@section('content')
    <div id="app">
        @include('layout.header_teams')

        <div class="container-fluid">
            <div class="content-container">
                <team-detail-container :team_id="{{intval($team_id)}}" />
            </div>
        </div>
    </div>
@endsection