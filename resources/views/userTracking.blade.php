<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <div class="container">
        <div class="row" style="margin-bottom: 1%">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to menù
            </a>
        </div>
        <div class="content">
            <div class="col-lg-6">
                <table class="table table-bordered table-striped" style="border:1px dotted black;">
                  <thead>
                  <tr>
                      <th>Artwork</th>
                  </tr>
                  </thead>
                  <tbody id="artTable">
                  </tbody>
              </table> 
            </div>
            <div id="map_area">
            @foreach ($rooms_list as $room)
                <div>
                    <div style="position: relative;">
                        <canvas class="art" id="art:{{$room->id}}" width="{{$room->width}}" height="{{$room->length}}" style="border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
                        <canvas class="map" id="map:{{$room->id}}" width="{{$room->width}}" height="{{$room->length}}" style="border: 1px solid black; position: relative; left: 0; top: 0; z-index: 0;"></canvas>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <script type = "text/javascript">

        $(document).ready(function() {
            loadArt ( {{ $response["Floor"] }} );
            ajaxd();
            setInterval(ajaxd, 3000);
        });

        function loadArt(num){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('Ajax_getArtworkByMuseum') }}",
                data:{'museum':{{ $museum_id }}, 'floor':num},
                type:'POST',
                success:  function (response) {
                    $.each(response['response'], function (key, value) {
                        drawArt("art:"+value.room_id, value.ID, value.title, value.posx, value.posy);
                    })
                }
            });
        }

        function loadFloor(num){
            div_area = document.getElementById("map_area");
            div_area.innerHTML = "";
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('Ajax_getArtworkByMuseum') }}",
                    data:{'museum':{{ $museum_id }}, 'floor':num},
                    type:'POST',
                    success:  function (response) {
                        $.each(response['rooms'], function (key, value) {
                            $('#map_area').append("<div><div style='position: relative;'>\
                                <canvas class='art' id='art:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;'></canvas>\
                                <canvas class='map' id='map:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: relative; left: 0; top: 0; z-index: 0;'></canvas>\
                                </div></div>");
                        }),
                        $.each(response['response'], function (key, value) {
                                    let x = (Math.random() * 400) + 1;
                                    let y = (Math.random() * 400) + 1;
                                    drawArt("art:"+value.room_id, value.id, value.title, x, y);
                                })
                    }
                });
        }

        function drawCoordinates(map,n,x,y){
            var pointSize = 3; // Change according to the size of the point.
            var ctx = document.getElementById(map).getContext("2d");

            ctx.fillStyle = "#ff2626"; // Red color

            ctx.beginPath(); //Start path
            ctx.arc(x+2, y+2, pointSize, 0, Math.PI * 2, true); // Draw a point using the arc function of the canvas with a point structure.
            ctx.fill(); // Close the path and fill.
            ctx.font = "12px Arial";
            ctx.strokeText("ID " + n, x+7, y+10)
        }

        function drawArt(art,id,n,x,y){
            var pointSize = 3; // Change according to the size of the point.
            var ctx = document.getElementById(art).getContext("2d");

            ctx.fillStyle = "#0000ff"; // Blue Color

            ctx.beginPath(); //Start path
            ctx.arc(x+2, y+2, pointSize, 0, Math.PI * 2, true); // Draw a point using the arc function of the canvas with a point structure.
            ctx.fill(); // Close the path and fill.
            ctx.font = "12px Arial";
            ctx.fillText(n, x+7, y+10)
        };

        function ajaxd() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('userVisitUpdate') }}",
                data:{{{ $museum_id }}},
                type:'POST',
                success:  function (response) {
                    $('#artTable').text("");
                    var user_canvas = document.getElementsByClassName("map");
                    $(user_canvas).each(function() {
                        var ctx2 = this.getContext("2d");
                        ctx2.clearRect(0, 0, this.width, this.height);
                    });
                    if(response['artworks_list'] !== undefined)
                        $.each(response['artworks_list'], function (key, value) {
                            //Carico le opere sulla tabella
                            $('#artTable').append("<tr>\
                                    <td>"+value.title+"</td>\
                                    <td><a class='nav-link dropdown-toggle' href='{{ url('museum/artwork/"+ value.ID +"') }}'>INFO</a></td>\
                                    </tr>");
                        })
                    //check if exist map with room index, otherwise reloading the floor
                    var myEle = document.getElementById("map:"+response['response'].Room);
                    if(myEle) {
                    }
                    else {
                        loadFloor(response['response'].Floor)
                    }
                    drawCoordinates("map:"+response['response'].Room, response['response'].ID, response['response'].PosX, response['response'].PosY)
                }
            });
        }

    </script>
</body>