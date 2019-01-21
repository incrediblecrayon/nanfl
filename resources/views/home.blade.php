@extends('layout.app')

@section('content')
    <div id="app">
        @include('layout.header_teams')

        <div class="container-fluid">
            <div class="content-container">
                <div class="jumbotron">
                    <h1 class="display-4">Not a National Football League</h1>
                    <p class="lead">You might be thinking 'Hey, isn't this like the NFL?' Rest assured friend, it is not.</p>
                    <hr class="my-4">
                    <p>Please do not tell the NFL that we exist. We follow fight club rules.</p>
                    {{--<a class="btn btn-primary btn-lg" href="/teams" role="button">NaNFL Teams</a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection