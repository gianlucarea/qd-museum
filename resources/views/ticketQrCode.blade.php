<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/tickets') }}">
                Return to tickets
            </a>
        </div>
        <div class="row" style="margin-bottom: 1%">
            <p>QrCode</p>
        </div>
        @php($user_id = Auth::user()->id)
        @foreach($tickets as $ticket)
            <div class="card-body">
                {!! QrCode::size(300)->generate('ticket_id:'.$ticket->id.'user_id:'.$user_id) !!}
            </div>
        @endforeach
    </div>
</body>