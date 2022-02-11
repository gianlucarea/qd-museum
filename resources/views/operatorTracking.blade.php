<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="/js/canvasManagement.js"></script>

    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/chooseMuseumForTracking') }}">
                Return to museum choise
            </a>
        </div>
        <div class="content">
            <div class="col-lg-6">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>User ID</th>
                      <th>Position X</th>
                      <th>Position Y</th>
                  </tr>
                  </thead>
                  <tbody id="exampleid">
                  </tbody>
              </table> 
            </div>
            <div>
                <canvas id="map" width="690" height="651" style="border: 1px solid black;"></canvas>
            </div>
        </div>
    </div>
    <script type = "text/javascript">
    $(document).ready(function() {
        ajaxd();
        setInterval(ajaxd, 2000);
    });

    function drawCoordinates(n,x,y){
    var pointSize = 3; // Change according to the size of the point.
    var ctx = document.getElementById("map").getContext("2d");

    ctx.fillStyle = "#ff2626"; // Red color

    ctx.beginPath(); //Start path
    ctx.arc((x*4)+2, (y*4)+2, pointSize, 0, Math.PI * 2, true); // Draw a point using the arc function of the canvas with a point structure.
    ctx.fill(); // Close the path and fill.
    ctx.font = "12px Arial";
    ctx.strokeText("ID " + n, (x*4)+7, (y*4)+10)
    }

    function ajaxd() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('operatorTrackingUpdate') }}",
            data:{'museum':1},
            type:'POST',
            success:  function (response) {
                $('#exampleid').text("");
                var canvas = document.getElementById("map");
                var ctx = canvas.getContext("2d")
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                $.each(response['response'], function (key, value) { 
							$('#exampleid').append("<tr>\
										<td>"+value.ID+"</td>\
										<td>"+value.PosX+"</td>\
										<td>"+value.PosY+"</td>\
										</tr>");
                            drawCoordinates(value.ID, value.PosX, value.PosY)
						})
            }
            });
        }
    </script>
</body>