
<link href="<?= base_url() ?>assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<style>
.pac-container {
        z-index: 9999;
    }

    .my_height {
        height: 50px !important;
    }
.bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
      	font-size: 16px;
      	font-weight: bold;
        position: relative;
    	top: 2px;
    }
    .card-header{
        background: #FFFFFF !important; border-radius:10px; 
    }
</style>
    <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Address <small>(Search Goole Places)</small></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Business Name" required>
                            <input type="hidden" name="mapData" id="mapData" >
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                            
                        </div>
                    </div>
                    
    </div>
<row class="row">
    <div class="col-md-8" style="padding-left: 0px;padding-right: 7px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Geo Fence &nbsp; <button type="button" onclick="initMap()" class="btn btn-sm btn-warning"><i class="fa fa-refresh fa-spin"></i>&nbsp; Redraw Fence</button>
                    <button name="add_batch" id="add_batch" class="btn btn-primary" style="float:right">Add Batch</button>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <div style="height: 600px;">
                    <div id="mapx" style="height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4" style="padding-left: 0px;padding-right: 7px;"> 
        <div class="card">
            <div class="card-header">
                <h2>Batch Record</h2>
                <hr>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
        
        
                </div>
            </div>
        </div>       
    </div>

   

</row>


<!-- End Update Modal -->
<script src="<?= base_url() ?>assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYos2QpHr6aZNyRtQzoBA6NsXEljXT8gg&callback=initMap&libraries=drawing,places&v=weekly" defer></script>
<script>
    var bounds = [];
    let drawingManager;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("mapx"), {
            center: {
                lat: 30.676787,
                lng: 73.110101
            },
            zoom: 18,
            // mapTypeId: "terrain",
        });
        const input = document.getElementById("address");
        const searchBox = new google.maps.places.SearchBox(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const boundsx = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    boundsx.union(place.geometry.viewport);
                } else {
                    boundsx.extend(place.geometry.location);
                }
            });
            map.fitBounds(boundsx);
        });

        // Define the LatLng coordinates for the polygon's path.

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    google.maps.drawing.OverlayType.POLYGON
                ],
            },
            markerOptions: {
                icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
            },
            polygonOptions: {
                fillColor: "#1C7A8B",
                fillOpacity: .3,
                strokeColor: "#000000",
                strokeWeight: 4,
                strokeOpacity: 0.9,
                clickable: true,
                editable: false,
                zIndex: 1,
            },

        });
        drawingManager.setMap(map);
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            var polygonBounds = polygon.getPath();
            bounds = [];
            for (var i = 0; i < polygonBounds.length; i++) {
                var point = {
                    lat: polygonBounds.getAt(i).lat(),
                    lng: polygonBounds.getAt(i).lng()
                };
                
                bounds.push(point);
            }
            // $('#mapData').val();
            var mapData = JSON.stringify(bounds);
            $("#mapData").val($("#mapData").val() + '-'+mapData.substring(1,mapData.length-1));
            //removeLine();
        });
    }

    function removeLine() {
        drawingManager.setMap(null);
    }
$("#add_batch").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('marking_area/add_batch') ?>",
        data: { 
            batch_data: $("#mapData").val(),
        },
        success: function(result) { 
            showbatchData();
            initMap();
        },
        error: function(result) {}
    });
});

function showbatchData(){
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('marking_area/get_batch') ?>",
        success: function(data) {
            //alert(data);
            $("#accordionExample").html('');
             $("#accordionExample").html(data);
            }
        });
}
function removeBatch(id){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('marking_area/remove_batch') ?>",
        data: { 
            batch_id: id,
        },
        success: function(result) { showbatchData();},
        error: function(result) {}
    });
}
     $(document).ready(function(){

        showbatchData();
        // Add down arrow icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
        });
        
        // Toggle right and down arrow icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
        });
    });
</script>