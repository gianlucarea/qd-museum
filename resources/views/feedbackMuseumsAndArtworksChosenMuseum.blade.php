<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <div class="row" style="margin-bottom: 1%">
            @foreach($museums as $museum)
                @if($museum_reviewed == True)
                    <p><b>{{$museum->name}}</b>({{$museum->address}}). You have already feedback this museum!</p>
                    <p>{{$museum->description}}</p>
                @else
                    <p><b>{{$museum->name}}</b>({{$museum->address}}). <a href=" {{'/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackMuseumPage/'.$museum->id }}"> Give a feedback!</a></p>
                    <p>{{$museum->description}}</p>
                @endif
            @endforeach
        </div>
        <div class="row">
            <b>artworks</b>
        </div>
        @php($user = Auth::user())
        @foreach($rooms as $room)
            @foreach($artworks as $artwork)
                @if($artwork->room_id == $room->id)
                    @php($counter = 0)
                    @foreach($artwork_reviews as $artwork_review)
                        @if($artwork_review->artwork_id == $artwork->id && $artwork_review->user_id == $user->id)
                            <div class="Artwork" style="padding: 2px 16px; width:80%">
                                <p><strong>{{$artwork->title}}</strong>. You have already feedback this artwork!</p>
                                <p>{{$artwork->description}}</p>
                            </div>
                            @php($counter = $counter + 1)
                        @endif
                    @endforeach
                    @if($counter == 0)
                        <div class="Artwork" style="padding: 2px 16px; width:80%">
                            <p><strong>{{$artwork->title}}</strong>. <a href="{{'/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackArtworkPage/'.$museum->id.'/'.$artwork->id }}"> Give a feedback!</a></p>
                            <p>{{$artwork->description}}</p>
                        </div>
                    @endif
                @endif
            @endforeach
        @endforeach
    </div>
</body>