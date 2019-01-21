@extends('layout.app')

@section('content')
    <div id="app">
        @include('layout.header_teams')

        <div class="container-fluid">
            <div class="content-container">

                <h1 class="text-center">Look at all the teams!</h1>

                @foreach($teams as $team)
                    <team-title :team-data="{{json_encode($team)}}"> <!-- TODO - Remove useless data.-->

                    </team-title>
                    <hr>
                    <br>
                @endforeach

            </div>
        </div>
    </div>
@endsection