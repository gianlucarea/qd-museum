<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <form method="GET" action="{{ url('/operator/tracking') }}"
        @csrf
        <div class="row">
            @foreach($museums as $museum)
                <input type="radio" id="{{ $museum->id }}" name="museum" value="{{ $museum->id }}">
                <label for="{{ $museum->id }}"> {{ $museum->name }} </label><br>
            @endforeach
        </div>
        @isset($message)
            <div class="row">
                <p><b>WARNING</b>: {{$message}}</p>
            </div>
        @endisset
        <div class="row">
            <button type="submit">
                Go to Museum
            </button>
        </div>
    </div>
    </div>
    </body>