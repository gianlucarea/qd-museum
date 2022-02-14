<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <div class="row" style="margin-bottom: 1%">
            <p>feedback of museum:</p>
            <ul>
                @foreach($museums as $museum)
                    <li><p><a href="{{'socialArea/museum/'.$museum->id}}">{{$museum->name}}</a></p></li>
                @endforeach
            </ul>
        </div>
        <div class="row" style="margin-bottom: 1%">
            <p style="font-size: 24px"><b> All feebacks</b></p>
        </div>
        @php($counter = 0)
        <div class="row" style="margin-bottom: 1%">
            <ul>
                @foreach($merged_reviews as $merged_review)
                    @php($counter = $counter + 1)
                    <li>
                        <p>{{$merged_review->username}} - <i>{{$merged_review->name}}</i></p>
                        <p>Title: <b>{{$merged_review->review_title}}</b> - {{$merged_review->stars}}</p>
                        <p>{{$merged_review->review_text}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        @if($counter == 0)
            <div class="row" style="margin-bottom: 1%">
                <p>nobody have given a feedback. If you have visited a museum go in the section <i>"Give a feedback to museum and artworks!"</i> and become the first of this community to give a feedback!</p>
            </div>
        @endif
    </div>
</body>