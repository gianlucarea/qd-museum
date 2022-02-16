<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to Home
        </a>
        <br>
        <a class="navbar-brand" href="{{ url('/museum/showArtworks/'.$museum->id) }}">
            Return to artworks management and statistics
        </a>
    </div>
    <div>
        <div class="container" style=" display: flex; flex-direction: row; width:100%">
            <ul class="container-ul" style=" display: inline-flex; flex-direction: row; width:100%">
                <li>
                   <div class="Artwork" style="padding: 2px 16px; width:80%">
                       <p><strong>{{$artwork->title}}</strong></p>
                       <p>{{$artwork->description}}</p>
                       @if($stars != 0)
                           <p>Average stars on review on this artwork: <b>{{$stars}}</b> stars</p>
                       @else
                           <p>Seems that nobody has given feedback on this artwork</p>
                       @endif
                       @if($avg_time != 0)
                           @if($avg_time_minutes < 10)
                               <p>Average time of visits on this artwork: <b>0{{$avg_time_minutes}}:{{$avg_time_seconds}}</b> minutes</p>
                           @else
                               <p>Average time of visits on this artwork: <b>{{$avg_time_minutes}}:{{$avg_time_seconds}}</b> minutes</p>
                           @endif
                       @else
                           <p>Seems that nobody has given attention on this artwork</p>
                       @endif
                       @if(Auth::user()->role == 2 || Auth::user()->role == 3)
                           <a href="/museum/update/artwork/{{$artwork->id}}">Update</a>
                           <br>
                           <a href="/museum/artworks/delete/{{$artwork->id}}" class="btn btn-danger" onclick="
                                 var result = confirm('Are you sure you want to delete this record?');
                                 if(!result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();}">
                               Delete
                           </a>
                       @endif
                   </div>
                </li>
            </ul>
        </div>
    </div>
</body>