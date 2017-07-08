@extends('layout.app')

@section('title')
    AquApp 2.0
@endsection

@section('styles')
    <!-- Jquery ui -->
    <link href="https://code.jquery.com/ui/1.12.0-rc.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <!-- Leaflet -->
    <link href="/libs/leaflet/leaflet.css" rel="stylesheet">
@endsection

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 scrollcol">
                    <form method="POST" action="{{ url('/') }}">
                        {{csrf_field()}}

                        <div class="row row-margin">
                            <div class="col-xs-12">
                                <h3><strong>Available Data</strong></h3>
                                <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                            </div>

                            <div class="col-md-8 col-xs-8 col-sm-8 pull-right">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <small>Real Time</small>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <small>Non RT</small>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <small>Off</small>
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="radio">
                                    <label class="small-label"><input type="radio" name="station_type" value="water_quality" checked> Water Quality</label>
                                </div>
                            </div>

                            <div class="col-md-8 col-xs-8 col-sm-8">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="radio">
                                    <label class="small-label"><input type="radio" name="station_type" value="hydrometereologic_factors" >Hydro-Meteorologic Factors</label>
                                </div>
                            </div>

                            <div class="col-md-8 col-xs-8 col-sm-8">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img src="/images/marker-icon-2x.png" class="marker" alt="marker">
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-4" for="from"> Start Date </label>
                                <div class="col-md-8 col-sm-6 col-xs-8">
                                    <input id="from" type="text" class="form-control datepicker" name="start_date">
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-4" for="to"> End Date </label>
                                <div class="col-md-8 col-sm-6 col-xs-8">
                                    <input id="to" type="text" class="form-control datepicker" name="end_date">
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <label class="control-label col-md-3 col-sm-3 col-xs-4"> Preselect End Date </label>
                            <div class="col-md-8 col-sm-6 col-xs-8">
                                <ul class="inline-links">
                                    <li><a href="javascript:void(0)">1 Day</a></li>
                                    <li><a href="javascript:void(0)">1 Week</a></li>
                                    <li><a href="javascript:void(0)">1 Month</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-4" for="station"> Station </label>
                                <div class="col-md-8 col-sm-6 col-xs-8">
                                    <select class="form-control" id="station" name="station">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row row-margin">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-4" for="parameter"> Parameter </label>
                                <div class="col-md-8 col-sm-6 col-xs-8">
                                    <select class="form-control" id="parameter" name="parameter">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-4" for="parameter"> Output Format </label>
                                <div class="col-md-8 col-sm-6 col-xs-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="output_format" value="graph" checked> Graph
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="output_format" value="csv"> CSV File
                                    </label>
                                </div>

                            </div>
                        </div>

                        <br>

                        <div class="row row-margin">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Get Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 fixedcol">
                    <div id="map"></div>

                    <div class="row">
                        <div class="col-md-2">
                            <small><strong>Water Quality labels</strong></small>
                        </div>

                        <div class="col-md-10">
                            <a href="#"><span class="label label-success">Optimal</span></a>
                            <a href="#"><span class="label label-info">Good</span></a>
                            <a href="#"><span class="label label-warning">Average</span></a>
                            <a href="#"><span class="label label-danger">Poor</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Jquery ui -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <!-- Leaflet -->
    <script src="/libs/leaflet/leaflet.js"></script>

    <script>
        $( function() {
            <!-- Datepicker jquery ui -->
            var dateFormat = "dd/mm/yy",
                from = $( "#from" )
                    .datepicker({
                        defaultDate: "+1w",
                        changeMonth: true,
                        numberOfMonths: 1
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
                        defaultDate: "+1w",
                        changeMonth: true,
                        numberOfMonths: 1
                    })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }

            <!-- Leaflet Map -->
            var map = L.map('map').setView([10.4207375,-75.5475544], 15);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                id: 'mapbox.streets'
            }).addTo(map);

        });
    </script>
@endsection