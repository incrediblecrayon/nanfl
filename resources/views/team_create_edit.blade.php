@extends('layout.app')

@section('content')
    <div id="app">
        @include('layout.header_teams')

        <div class="container-fluid">
            <div class="content-container">
                <form-team-create-edit :team_id="{{intval($team_id)}}" :teams="{{$teams}}">
                    <template slot="title">
                        @if (isset($team_id))
                            <h1>Edit Team ID: #{{$team_id}}</h1>
                        @else
                            <h1>Create Team</h1>
                        @endif
                    </template>
                </form-team-create-edit>
            </div>
        </div>
    </div>
@endsection