<body>
<div class="container">
    <div class="row" style="margin-bottom: 1%">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to home
        </a>
    </div>
    <form method="GET" action="{{ url('/museum/showArtworks') }}"
    @csrf
    <div class="row" style="margin-bottom: 1%">
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
    <div class="row" style="margin-bottom: 1%">
        <button type="submit">
            go to artwork management and statistics
        </button>
    </div>
</div>
</div>
</body>