<head>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @foreach($museums as $museum)
        @php($museum_name = $museum->name)
    @endforeach
    @foreach($tags as $tag)
        @php($tag_code = $tag->code)
    @endforeach
    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to tickets
            </a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
            </div>
            <div class="col-md-6">
                <label>SCAN QR CODE</label>
                <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
            </div>
        </div>
        <div class="row" style="margin-top: 1%; margin-bottom: 1%">
            <p>Museum: <input type="text" value="{{ $museum_name }}" name="m_{{$museum->id}}" readonly></p>
            <input type="text" value="{{ $museum->id }}" name="museum_id" id="m_id" readonly hidden>
        </div>
        <div class="row" style="margin-bottom: 1%">
            <p>Tag: <input type="text" value="{{ $tag_code }}" name="t_{{$tag->id}}" readonly></p>
            <input type="text" value="{{ $tag->id }}" name="tag_id" id="t_id" readonly hidden>
        </div>
    </div>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if (cameras.length > 0) {
                scanner.start(cameras[0])
            } else {
                alert('no cameras found');
            }
        }).catch(function(e){
            console.error(e)
        });

        scanner.addListener('scan', function (c) {
            let qrString = c;
            document.getElementById('text').value = "validation in progress";
            if(qrString.includes('ticket_id:') && qrString.includes('user_id:')) {
                qrString = qrString.replace('ticket_id:', '')
                qrString = qrString.replace('user_id:', '-')
                let divisor = qrString.indexOf('-')
                let ticket_id = qrString.substring(0, divisor)
                let user_id = qrString.substring(divisor + 1)
                let museum_id = String(document.getElementById('m_id').value);
                let tag_id = String(document.getElementById('t_id').value);
                let url = "{{ url('validation/museum_id/tag_id/ticket_id/user_id') }}";
                url = url.replace('museum_id', museum_id);
                url = url.replace('tag_id', tag_id);
                url = url.replace('ticket_id', ticket_id);
                url = url.replace('user_id', user_id);
                document.location.href = url
            } else {
                document.getElementById('text').value = "error: QRcode not accepted";
            }
        })
    </script>
</body>