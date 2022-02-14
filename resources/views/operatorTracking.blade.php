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
                      <th>Floor</th>
                  </tr>
                  </thead>
                  <tbody id="userTable">
                  </tbody>
              </table> 
            </div>
            <div>
                <input type="checkbox" name="artCtrl" id="artCtrl" title="Show/Hide Art" value="1"/>Show/Hide Artwork
            </div>
            <div>
                <form id="floorSelect">
                @foreach ($floors_list as $floor)
                    @if ($loop->first)   
                        <input type="radio" name="option" value="{{$floor->height}}" title="{{$floor->height}}" checked="checked"/> {{$floor->height}}
                    @else
                        <input type="radio" name="option" value="{{$floor->height}}" title="{{$floor->height}}"/> {{$floor->height}}
                    @endif
                @endforeach
            </div>
            <div id="map_area">
            @foreach ($rooms_list as $room)
            @if ($floors_list->first()->height == $room->height)
                <div>
                    <div style="position: relative;">
                        <canvas class="art" id="art:{{$room->id}}" width="{{$room->width}}" height="{{$room->length}}" style="border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
                        <canvas class="map" id="map:{{$room->id}}" width="{{$room->width}}" height="{{$room->length}}" style="border: 1px solid black; position: relative; left: 0; top: 0; z-index: 0;"></canvas>
                    </div>
                </div>
            @endif
            @endforeach
            </div>
            <!--
            <div style="position: relative;">
                <canvas id="art" width="690" height="651" style="border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
                <canvas id="map" width="690" height="651" style="border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
            </div>
            -->
        </div>
    </div>
    <script type = "text/javascript">

    $(document).ready(function() {
        ajaxd();
        setInterval(ajaxd, 3000);
    });

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

    function drawArt(art,n,x,y){
        var pointSize = 3; // Change according to the size of the point.
        var ctx = document.getElementById(art).getContext("2d");

        ctx.fillStyle = "#0000ff"; // Blue Color

        ctx.beginPath(); //Start path
        ctx.arc(x+2, y+2, pointSize, 0, Math.PI * 2, true); // Draw a point using the arc function of the canvas with a point structure.
        ctx.fill(); // Close the path and fill.
        ctx.font = "12px Arial";
        ctx.fillText("ID " + n, x+7, y+10)
        };

    $("form :input").change(function() {
        //clear map and art area
        div_area = document.getElementById("map_area");
        div_area.innerHTML = "";
        if ($("#artCtrl").prop('checked')){
            //Show Art
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('Ajax_getArtworkByMuseum') }}",
                data:{'museum':{{ $museum_id }}, 'floor':$('input[name=option]:checked','#floorSelect').val()},
                type:'POST',
                success:  function (response) {
                    //$('#exampleid').text("");
                    $.each(response['rooms'], function (key, value) {
                        $('#map_area').append("<div><div style='position: relative;'>\
                            <canvas class='art' id='art:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;'></canvas>\
                            <canvas class='map' id='map:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: relative; left: 0; top: 0; z-index: 0;'></canvas>\
                            </div></div>");
                    }),
                    $.each(response['response'], function (key, value) {
                                let x = (Math.random() * 100) + 1;
                                let y = (Math.random() * 100) + 1;
                                drawArt("art:"+value.room_id, value.title, x, y);
                            })
                }
            });
        }
        else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('Ajax_getArtworkByMuseum') }}",
                data:{'museum':{{ $museum_id }}, 'floor':$('input[name=option]:checked','#floorSelect').val()},
                type:'POST',
                success:  function (response) {
                    //$('#exampleid').text("");
                    $.each(response['rooms'], function (key, value) {
                        $('#map_area').append("<div><div style='position: relative;'>\
                            <canvas class='art' id='art:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: absolute; left: 0; top: 0; z-index: 0;'></canvas>\
                            <canvas class='map' id='map:" + value.id + "' width='" + value.width + "' height='" + value.length + "' style='border: 1px solid black; position: relative; left: 0; top: 0; z-index: 0;'></canvas>\
                            </div></div>");
                    })
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    });

    $("#artCtrl").on('change', function () {
        var art_canvas = document.getElementsByClassName("art");
        $(art_canvas).each(function() {
            var ctx2 = this.getContext("2d");
            ctx2.clearRect(0, 0, this.width, this.height);
        });
        if ($("#artCtrl").prop('checked')){
            //Show Art
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('Ajax_getArtworkByMuseum') }}",
                data:{'museum':{{ $museum_id }}, 'floor':$('input[name=option]:checked','#floorSelect').val()},
                type:'POST',
                success:  function (response) {
                    $.each(response['response'], function (key, value) {
                                let x = (Math.random() * 100) + 1;
                                let y = (Math.random() * 100) + 1;
                                drawArt("art:"+value.room_id, value.title, x, y);
                            })
                }
            });
        }
        else{
            //Hide Art
        }
    });
    function ajaxd() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('operatorTrackingUpdate') }}",
            data:{'museum':{{ $museum_id }}, 'floor':$('input[name=option]:checked','#floorSelect').val()},
            type:'POST',
            success:  function (response) {
                $('#userTable').text("");
                var user_canvas = document.getElementsByClassName("map");
                $(user_canvas).each(function() {
                    var ctx2 = this.getContext("2d");
                    ctx2.clearRect(0, 0, this.width, this.height);
                });
                $.each(response['response'], function (key, value) { 
							$('#userTable').append("<tr>\
										<td>"+value.ID+"</td>\
										<td>"+value.PosX+"</td>\
										<td>"+value.PosY+"</td>\
                                        <td>"+value.Floor+"</td>\
										</tr>");
                            drawCoordinates("map:"+value.Room, value.ID, value.PosX, value.PosY)
						})
            }
            });
        }
    </script>
</body>