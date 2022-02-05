<body>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            Return to Home
        </a>
        <div class="row justify-content-center" style="margin-top: 1%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Booking ticket - buy confirmation') }}</div>
                    <div class="card-body">
                        @foreach($museums as $museum)
                            @php($museum_name = $museum->name) {{--segna errore ma non lo è davvero--}}
                        @endforeach
                        @isset($time_slots)
                            @foreach($time_slots as $time_slot)
                                @php($time_slot_description = $time_slot->description) {{--segna errore ma non lo è davvero--}}
                            @endforeach
                        @endisset
                        <div class="row" style="margin-bottom: 1%">
                            <p>Museum: <input type="text" value="{{ $museum_name }}" name="musuem_{{$museum->id}}" readonly></p>
                        </div>
                        <div class="row" style="margin-bottom: 1%">
                            <p>Visit date: <input type="date" value="{{ $visit_date }}" name="visit_date" readonly></p>
                        </div>
                        @isset($time_slot_description)
                            <div class="row" style="margin-bottom: 1%">
                                <p>intended time slot: <input type="text" value="{{ $time_slot_description }}" name="time_slot" readonly></p>
                            </div>
                        @endisset
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>