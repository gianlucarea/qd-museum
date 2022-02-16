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
                    <form method="post" action="{{ url('/storeArtwork') }}">
                        @csrf
                        <div class="row" style="margin-bottom: 1%">
                            <label for="museum">Museum:</label>
                            <input type="text" value="{{$museum->name}}" id="{{$museum->id}}" name="museum"  readonly>
                            <input type="text" value="{{ $museum->id }}" name="museum_id" readonly hidden>
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <label for="description">Description:</label>
                            <input type="description" id="description" name="description">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <label for="room_id">Room_Number_ID:</label>
                            <input type="room_id" id="room_id" name="room_id">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <button type="submit" class="btn btn-primary">
                                Insert Artwork
                            </button>
                        </div>
                        @isset($error)
                            <div class="row" style="margin-bottom: 1%">
                                <p style="color: red"> {{ $error }}</p>
                            </div>
                        @endisset
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>