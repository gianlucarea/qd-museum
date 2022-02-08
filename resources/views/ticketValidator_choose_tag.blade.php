<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <div class="row">
            @foreach($museums as $museum)
                @php($museum_name = $museum->name) {{--segna errore ma non lo è davvero--}}
            @endforeach
            <form method="GET" action="{{ url('/ticketValidator/QrCodeReader') }}">
                @csrf
                <div class="row" style="margin-bottom: 1%">
                    <p>Museum: <input type="text" value="{{ $museum_name }}" name="m_{{$museum->id}}" readonly></p>
                    <input type="text" value="{{ $museum->id }}" name="museum_id" readonly hidden>
                </div>
                <div class="row" style="margin-bottom: 1%">
                    @foreach($tags as $tag)
                        <input type="radio" id="{{ $tag->id }}" name="tag_id" value="{{ $tag->id }}">
                        <label for="{{ $tag->id }}"> <b>TAG</b>: {{ $tag->code }} </label><br>
                    @endforeach
                </div>
                @isset($message)
                    <div class="row">
                        <p><b>WARNING</b>: {{$message}}</p>
                    </div>
                @endisset
                <div class="row" style="margin-bottom: 1%">
                    <button type="submit" class="btn btn-primary">
                        go to QR code reader
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>