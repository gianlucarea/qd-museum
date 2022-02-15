<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to Home
        </a>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/museum/update/artwork/by/'.$artwork->id) }}" method="POST">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$artwork->title}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <input type="text" name="description" value="{{$artwork->description}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Room_Number_ID</label>
                                <input type="text" name="room_id" value="{{$artwork->room_id}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Update Artwork</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>





  