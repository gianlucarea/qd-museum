<body>
<div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        Return to Home
    </a>
    <div class="row justify-content-center" style="margin-top: 1%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/museum/update/slot/by/'.$slot->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">Slot Number</label>
                            <input type="text" name="slot_number" value="{{$slot->slot_number}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{$slot->description}}" class="form-control" style="width:50vh;">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Slot</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>