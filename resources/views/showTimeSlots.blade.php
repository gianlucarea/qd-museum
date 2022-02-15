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
        <h1 style="width: 100%"> Time slot del museo <br> <strong>{{$museum->name}}</strong></h1>

        <div class="container" style=" display: flex; flex-direction: row; width:100%">
            <ul class="container-ul" style=" display: inline-flex; flex-direction: row; width:100%">
            @foreach($time_slots as $time_slot)
                    <li>
                       <div class="Artwork" style="padding: 2px 16px; width:80%">
                           <p>{{$time_slot->slot_number}}</p>
                           <p>{{$time_slot->description}}</p>
                           <a href="/museum/update/slot/{{$time_slot->id}}">Update</a>
                            <br>
                           <a href="/museum/slot/delete/{{$time_slot->id}}" class="btn btn-danger" onclick="
                                 var result = confirm('Are you sure you want to delete this record?');
                                 if(!result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();}">
                               Delete
                           </a>
                       </div>
                    </li>
        @endforeach
            </ul>
        </div>
</div>
</body>