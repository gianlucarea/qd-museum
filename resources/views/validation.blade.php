<body>
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/ticketValidator') }}">
                Return to QrCode Validator
            </a>
        </div>
        <div class="row" style="margin-bottom: 1%">
            @if($success == 1)
                <p>the ticket is <b>validated</b> with success</p>
            @else
                <p>the ticket is <b>not validated</b>, error occured: {{ $description }}</p>
            @endif
        </div>
    </div>
</body>