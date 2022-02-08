<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <div class="row">
            <form method="POST" action="{{ url('/tagDecoupling/outcome') }}">
                @csrf
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
                        decoupling tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>