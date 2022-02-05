<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to Home
        </a>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Booking ticket - first phase: check availability') }}</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/bookingTicket/seeAvailability') }}">
                            <div class="row" style="margin-bottom: 1%">
                                <p>Please choose the museum you are interested to visit</p>
                                @foreach($museums as $museum)
                                    <input type="radio" id="{{ $museum->id }}" name="museum" value="{{ $museum->id }}">
                                    <label for="{{ $museum->id }}"> {{ $museum->name }} </label><br>
                                @endforeach
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <p>Please choose the date in which you are interested to visit the selected museum</p>
                                <label for="visitDate">visit date:</label>
                                <input type="date" id="visitDate" name="visitDate">
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <button type="submit" class="btn btn-primary">
                                    See Availability
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