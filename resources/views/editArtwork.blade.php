<body>
    <div class="container">
        <div class="row">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to Home
            </a>
        </div>
        <div class="row">
            <a class="navbar-brand" href="{{ url('/museum/showArtworks/'.$museum->id) }}">
                Return to artworks management and statistics
            </a>
        </div>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/museum/update/artwork/by/'.$artwork->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3" style="margin-bottom: 1%">
                                <label for="museum">Museum:</label>
                                <input type="text" value="{{$museum->name}}" id="{{$museum->id}}" name="museum"  readonly>
                                <input type="text" value="{{ $museum->id }}" name="museum_id" readonly hidden>
                            </div>
                            <div class="form-group mb-3" style="margin-bottom: 1%">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$artwork->title}}" class="form-control">
                            </div>
                            <div class="form-group mb-3"  style="margin-bottom: 1%">
                                <label for="">Description</label>
                                <input type="text" name="description" value="{{$artwork->description}}" class="form-control">
                            </div>
                            <div class="form-group mb-3"  style="margin-bottom: 1%">
                                <label for="">Room_Number_ID</label>
                                <input type="text" name="room_id" value="{{$artwork->room_id}}" class="form-control">
                            </div>
                            <div class="form-group mb-3"  style="margin-bottom: 1%">
                                <button type="submit" class="btn btn-primary">Update Artwork</button>
                            </div>
                        </form>
                        @isset($error)
                            <div class="row" style="margin-bottom: 1%">
                                <p style="color: red">{{$error}}</p>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>





  