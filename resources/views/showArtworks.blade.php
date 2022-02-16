<body>
<div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        Return to Home
    </a>
    <br>
    <a>
        <a href="{{url('/addArtwork/'.$museum->id)}}" class="btn btn-danger"> Add new Artwork</a>
    </a>
</div>
    <div >
        <p style="width: 100%"> Artworks of museum: <b>{{$museum->name}}</b><br/>
            @if($stars != 0)
                Average stars on review on this museum: <b>{{$stars}}</b> stars
            @else
                Seems that nobody has given feedback on this museum
            @endif
            <br/>
            @if($avg_time != 0)
                @if($avg_time_minutes < 10)
                    Average time of visits on this museum: <b>0{{$avg_time_minutes}}:{{$avg_time_seconds}}</b> minutes
                @else
                    Average time of visits on this museum: <b>{{$avg_time_minutes}}:{{$avg_time_seconds}}</b> minutes
                @endif
            @else
                Seems that nobody has given attention on this museum
            @endif
        </>
        <div class="container" style=" display: flex; flex-direction: row; width:100%">
            <ul class="container-ul" style=" display: inline-flex; flex-direction: row; width:100%">
        @foreach ($rooms as $room)
            @foreach($artworks as $artwork)
               @if($artwork->room_id == $room->id)
                    <li>
                       <div class="Artwork" style="padding: 2px 16px; width:80%">
                           <p><strong>{{$artwork->title}}</strong></p>
                           <p>{{$artwork->description}}</p>
                           <a href="{{url('/museum/artwork/'.$artwork->id)}}">Data&statistics</a>
                           <br>
                           <a href="{{url('/museum/update/artwork/'.$artwork->id)}}">Update</a>
                           <br>
                           <a href="{{url('/museum/artworks/delete/'.$artwork->id)}}" class="btn btn-danger" onclick="
                                 var result = confirm('Are you sure you want to delete this record?');
                                 if(!result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();}">
                               Delete
                           </a>
                       </div>
                    </li>
                @endif
            @endforeach
        @endforeach
            </ul>
        </div>
</div>
</body>