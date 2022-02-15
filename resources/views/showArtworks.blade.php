<body>
<div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        Return to Home
    </a>
    <br>
    <a>
        <a href="/addArtwork" class="btn btn-danger"> Add new Artwork</a>
    </a>
</div>
    <div >
        <div class="container" style=" display: flex; flex-direction: row; width:100%">
            <ul class="container-ul" style=" display: inline-flex; flex-direction: row; width:100%">
        @foreach ($rooms as $room)
            @foreach($artworks as $artwork)
               @if($artwork->room_id == $room->id)
                    <li>
                       <div class="Artwork" style="padding: 2px 16px; width:80%">
                           <p><strong>{{$artwork->title}}</strong></p>
                           <p>{{$artwork->description}}</p>
                           <a href="/museum/artwork/{{$artwork->id}}">See Artwork</a>
                           <br>
                           <a href="/museum/update/artwork/{{$artwork->id}}">Update</a>
                           <br>
                           <a href="/museum/artworks/delete/{{$artwork->id}}" class="btn btn-danger" onclick="
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