<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/bookingTicket') }}">
            Return to see Availability page
        </a>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Booking ticket - second phase: buy the ticket') }}</div>
                    <div class="card-body">
                        @foreach($museums as $museum)
                            @php($museum_name = $museum->name) {{--segna errore ma non lo è davvero--}}
                        @endforeach
                        <form method="POST" action="{{ url('/bookingTicket/ticketConfirmation') }}">
                            @csrf
                            <div class="row" style="margin-bottom: 1%">
                                <p>Museum: <input type="text" value="{{ $museum_name }}" name="m_{{$museum->id}}" readonly></p>
                                <input type="text" value="{{ $museum->id }}" name="museum_id" readonly hidden>
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <p>Visit date: <input type="date" value="{{ $visit_date }}" name="visit_date" readonly></p>
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <p>please set the time slot in which you intend to make the visit (optional, we need it only to make statistics)</p>
                                @php($counter = 0)
                                @foreach($time_slots as $time_slot)
                                    @foreach($time_slot_statistic_collection->keys() as $key)
                                        @if($time_slot->id == $key)
                                            @if($time_slot_statistic_collection->get($key) > 0)
                                                <input type="radio" id="{{ $time_slot->slot_number }}" name="timeSlot" value="{{ $time_slot->slot_number }}">
                                                <label for="{{ $time_slot->slot_number }}">{{ $time_slot->description }}. Already {{ $time_slot_statistic_collection->get($key) }} people have intention to visit the museum in this time slot</label><br>
                                            @else
                                                <input type="radio" id="{{ $time_slot->slot_number }}" name="timeSlot" value="{{ $time_slot->slot_number }}">
                                                <label for="{{ $time_slot->slot_number }}">{{ $time_slot->description }}. At the moment nobody has intention to visit the museum in this time slot</label><br>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                                <p><b>Warning</b>: remember that in the museum at most 500 people can be inside in a certain moment, so consider this before buy the ticket (if for this reason is impossible to get access, please request the refund) </p>
                            </div>
                            <div class="row" style="margin-bottom: 1%">
                                <button type="submit" class="btn btn-primary">
                                    Buy the ticket
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>