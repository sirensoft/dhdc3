<div id="map" style="width: 100%; height: 500px;"></div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["geochart"]});
    google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
            ['จังหวัด', 'จำนวน'],
            ['พิษณุโลก',10],
            ['บึงกาฬ',1],
            ['หนองคาย',100]
        ]);

        var options = {
            region: 'TH',
            resolution: 'provinces',
            //displayMode: 'markers',
            colorAxis: {colors: ['white', 'yellow', 'orange', 'red']}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('map'));

        chart.draw(data, options);
    }
</script>
