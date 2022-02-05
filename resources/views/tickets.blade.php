<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        @php($counter = 0)
        @foreach($tickets as $ticket)
            <div class="row">
                @if($ticket->validated == 0)
                    <b>ticket</b>: <a href="{{ url('ticketQrCode/'.$ticket->id) }}">See QrCode</a>
                @else
                    <b>ticket (expired)</b>:
                @endif
                @foreach($museums as $museum)
                    @if($museum->id == $ticket->museum_id)
                        @if($ticket->time_slot_number != 0)
                            @foreach($time_slots as $time_slot)
                                @if($time_slot->museum_id == $museum->id)
                                    @if($time_slot->slot_number == $ticket->time_slot_number)
                                        @php($time_slot_description = $time_slot->description)
                                    @endif
                                @endif
                            @endforeach
                            <p>{{$museum->name}}, date: {{$ticket->visit_date}} - {{ $time_slot_description }}.</p>
                        @else
                            <p>{{$museum->name}}, date: {{$ticket->visit_date}}</p>
                        @endif
                    @endif
                @endforeach
            </div>
            @php($counter = $counter + 1)
        @endforeach
        @if($counter == 0)
            <div class="row">
                you don't have booked tickets.
            </div>
        @endif
    </div>
</body>