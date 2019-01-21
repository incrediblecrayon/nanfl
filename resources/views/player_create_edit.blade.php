@extends('layout.app')

@section('content')
    <div id="app">
        @include('layout.header_teams')

        <div class="container-fluid">
            <div class="content-container">
                <form-player-create-edit :player_id="{{intval($player_id)}}" :teams="{{$teams}}">
                    <template slot="title">
                        @if (isset($player_id))
                            <h1>Edit Player ID: #{{$player_id}}</h1>
                        @else
                            <h1>Create Player</h1>
                        @endif
                    </template>
                </form-player-create-edit>
            </div>
        </div>
    </div>
@endsection