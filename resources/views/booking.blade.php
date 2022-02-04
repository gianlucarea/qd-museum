<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to Home
        </a>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Booking ticket') }}</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/bookingTicket/seeAvailability') }}">
                            <div class="row" style="margin-bottom: 1%">
                                <p>Choose the museum</p>
                                <input type="radio" id="museo1" name="museum" value="museo1">
                                <label for="museo1">Museum 1</label><br>
                                <input type="radio" id="museo2" name="museum" value="museo2">
                                <label for="museo2">Museum 2</label><br>
                                <input type="radio" id="museo3" name="museum" value="museo3">
                                <label for="museo3">Museum 3</label><br>
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <label for="visitDate">visit date:</label>
                                <input type="date" id="visitDate" name="visitDate">
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <p>Time slot Optional</p>
                                <input type="radio" id="timeSlot1" name="timeSlot" value="timeSlot1">
                                <label for="timeSlot1">Time Slot 1</label><br>
                                <input type="radio" id="timeSlot2" name="timeSlot" value="timeSlot2">
                                <label for="timeSlot2">Time Slot 2</label><br>
                                <input type="radio" id="timeSlot3" name="timeSlot" value="timeSlot3">
                                <label for="timeSlot3">Time Slot 3</label><br>
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <button type="submit" class="btn btn-primary">
                                    See Availability
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>