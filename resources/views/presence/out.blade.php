@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" 
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div id="current-location-map" style="min-height: 60vh;"></div>
                <form action="/presence/out" method="post" class="mt-3 mb-5">
                    @csrf
                    <input type="hidden" name="coordinate">
                    <button class="btn btn-sm btn-primary float-right">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
    </script>
    <script>
        var mymap = L.map('current-location-map').setView([-0.663953, 118.417879], 4);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZnJhenppZXIiLCJhIjoiY2tjYml3ajRnMTV2bDM0cGZ5M3poOGxxaSJ9.AFrcCKa6EYY7WnUJa4KKvw'
        }).addTo(mymap);

        mymap.locate({setView: true, maxZoom: 16});

        function onLocationFound(e) {
            var radius = e.accuracy;

            L.marker(e.latlng).addTo(mymap)
                .bindPopup("Anda ada dalam radius " + radius).openPopup();

            $('input[name=coordinate]').val(e.latlng.lat+', '+e.latlng.lng)
            L.circle(e.latlng, radius).addTo(mymap);
        }

        mymap.on('locationfound', onLocationFound);

        function onLocationError(e) {
            alert(e.message);
        }

        mymap.on('locationerror', onLocationError);

        var popup = L.popup();
    </script>
@endsection