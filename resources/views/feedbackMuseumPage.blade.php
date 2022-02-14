<body>
    <div class="container">
        <div class="row">
            @foreach($museums as $museum)
                @php($museum_name = $museum->name) {{--segna errore ma non lo è davvero--}}
            @endforeach
            <form method="POST" id="sendFeedback" action="{{ url('feedbackMuseumsAndArtworks/ChosenMuseum/feedbackMuseum') }}">
                @csrf
                <div class="row" style="margin-bottom: 1%">
                    <p>Museum: <input type="text" value="{{ $museum_name }}" name="m_{{$museum->id}}" readonly></p>
                    <input type="text" value="{{ $museum->id }}" name="museum" readonly hidden>
                </div>
                <div class="row" style="margin-bottom: 1%">
                    <p>title: <input type="text" name="title" id="title" placeholder="insert title of review"/></p>
                </div>
                <div class="row" style="margin-bottom: 1%">
                    <p>Description (optional): <input type="text" name="description" id="description" placeholder="insert description of review"/></p>
                </div>
                <div class="row" style="margin-bottom: 1%">
                    <label for="vote">Choose a car:</label>
                    <select name="vote" id="vote" form="sendFeedback">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="row" style="margin-bottom: 1%">
                    <button type="submit" class="btn btn-primary">
                        Send feedback
                    </button>
                </div>
            </form>
            @isset($message)
                <div class="row">
                    <p><b>WARNING</b>: {{$message}}</p>
                </div>
            @endisset
        </div>
    </div>
</body>
