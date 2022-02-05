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
        @foreach($tickets as $ticket)
            <div class="card-body">
                {!! QrCode::size(300)->generate($ticket->id) !!}
            </div>
        @endforeach
    </div>
</body>