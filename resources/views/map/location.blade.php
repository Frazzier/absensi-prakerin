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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
    </script>
    <script>
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        var mymap = L.map('current-location-map').setView([params.coordinate.split(", ")[0], params.coordinate.split(", ")[1]], 16);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZnJhenppZXIiLCJhIjoiY2tjYml3ajRnMTV2bDM0cGZ5M3poOGxxaSJ9.AFrcCKa6EYY7WnUJa4KKvw'
        }).addTo(mymap);

        var marker = L.marker([params.coordinate.split(", ")[0], params.coordinate.split(", ")[1]]).addTo(mymap)
            .bindPopup("Lokasi absensi").openPopup();

        marker.addTo(mymap);

        var popup = L.popup();
    </script>
@endsection