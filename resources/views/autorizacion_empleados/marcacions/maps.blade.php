@extends('layouts.app2')
@section('css')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap.min.css">
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Reporte GPS</h1>
    </section>
    <div class="clearfix"></div>
    <div class="clearfix"></div>

    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
          <div class="box-body">
            <div align="center" id="map_canvas" style="width:100%;height:450px;"></div>
            {!! Form::hidden('latitud', ($lat)? $lat : null, ['disabled'=> 'disabled', 'id'=> 'latitud', 'class' => 'form-control']) !!}
            {!! Form::hidden('longitud',($long)? $long : null, ['disabled'=> 'disabled', 'id'=> 'longitud', 'class' => 'form-control']) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}">
          </div>


        </div>
    </div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAph1Y5uOO5kNkeZFzcy1odYf4ADNSOmng&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
  var latlng = new google.maps.LatLng(4.7248181,-74.0716749);
  var myOptions = {
    zoom: 14,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map    = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  var marker = new google.maps.Circle({
    strokeColor: '#0000FF',
     strokeOpacity: 0.8,
     strokeWeight: 2,
     fillColor: '#FF0000',
     fillOpacity: 0.35,
     map: map,
     center: latlng,
     radius: 100
  });
  marker.setMap(map);

  var latlng2 = new google.maps.LatLng($("#latitud").val(), $("#longitud").val());

  // añadimos una segunda marca
  var marker2 = new google.maps.Marker({
      position: latlng2,
      title: 'USUARIO MARCACION',
      draggable: true
  });
  marker2.setMap(map);
  var popup2 = new google.maps.InfoWindow({
      content: 'USUARIO MARCACION',
      position: latlng2
  });
  popup2.open(map);

</script>
@endsection
