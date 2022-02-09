<body>
<div class="container">
    <div class="row" style="margin-bottom: 1%">
        <a class="navbar-brand" href="{{ url('/tickets') }}">
            Return to tickets
        </a>
    </div>
    <div class="row" style="margin-bottom: 1%">
        @if($success == 1)
            <p>The request for refund of the following ticket is sent, wait to be contacted by the administration</p>
            @foreach($tickets as $ticket)
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
                            <p><b>ticket description</b>: {{$museum->name}}, date: {{$ticket->visit_date}} - {{ $time_slot_description }}.</p>
                        @else
                            <p><b>ticket description</b>: {{$museum->name}}, date: {{$ticket->visit_date}}.</p>
                        @endif
                    @endif
                @endforeach
            @endforeach
        @else
            <p>The request for refund of the following ticket is <b>NOT</b> sent for the following problems:</p>
            @foreach($tickets as $ticket)
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
                            <p><b>ticket description</b>: {{$museum->name}}, date: {{$ticket->visit_date}} - {{ $time_slot_description }}.</p>
                        @else
                            <p><b>ticket description</b>: {{$museum->name}}, date: {{$ticket->visit_date}}.</p>
                        @endif
                    @endif
                @endforeach
            @endforeach
            <p>{{ $message }}</p>
        @endif
    </div>
</div>
</body>