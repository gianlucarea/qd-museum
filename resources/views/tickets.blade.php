<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        @php($counter = 0)
        @php($today = \Carbon\Carbon::now())
        @foreach($tickets as $ticket)
            <div class="row">
                <ul>
                    <li>
                        @php($date_ticket = \Carbon\Carbon::parse($ticket->visit_date))
                        @if($ticket->validated == 0)
                            @if($date_ticket->lte($today))
                                @if($ticket->refundRequest == 0)
                                    <b>ticket</b>: <a href="{{ url('requestRefund/'.$ticket->id) }}">The ticket is expired but never used, request a refund here.</a>
                                @else
                                    <b>ticket</b>: the ticket is expired for refund request.
                                @endif
                            @else
                                <b>ticket</b>: <a href="{{ url('ticketQrCode/'.$ticket->id) }}">See QrCode</a>
                            @endif
                        @else
                            <b>ticket</b>: the ticket is already used
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
                    </li>
                </ul>
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