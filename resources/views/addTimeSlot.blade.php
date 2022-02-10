<body>
<div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        Return to Home
    </a>
    <div class="row justify-content-center" style="margin-top: 1%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('/museum/storeTimeslot') }}">
                        @csrf
                        <div class="row" style="margin-bottom: 1%">
                            <label for="slot_number">Slot Number:</label>
                            <input type="text" id="slot_number" name="slot_number">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <input type="text" id="museum_id" name="museum_id" hidden value="{{request()->museum}}">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <label for="description">Description:</label>
                            <input type="description" id="description" name="description">
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <button type="submit" class="btn btn-primary">
                                Insert Slot
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