<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="js/saveSvgAsPng.js"></script>
<div id="container" style="height: 500px; width: 500px;float: left"></div>
<div id="pngOutput" style="height: 500px; width: 500px;float: left;"></div>
<div style="clear: both"></div>
<br/>
<input type="button" id="svg2png" value="Convert to PNG" />
<script type="text/javascript">
  $(function () {

      $("#svg2png").on('click', function () {
	
	highChartSVG2PNG("#container");
	
      });

      window.highChartSVG2PNG = function (obj) {

          var svgObj = $(obj + " svg")[0];
          try {
              options = {};
              options.encoderType = 'image/png';
              options.height = 700;
              options.width = 900;
              svgAsPngUri(svgObj, options, function (imgURL) {
                  $("#pngOutput").html('<img src="' + imgURL + '" />');

              });
          } catch (e) {
              console.log(e);
          }

      }


      $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
          // Create the chart
          $('#container').highcharts('StockChart', {
              rangeSelector: {
                  selected: true
              },
              title: {
                  text: 'AAPL Stock Price'
              },
              scrollbar: true,
              _navigator: {
                  enabled: false
              },
              navigator: {
                  enabled: true
              },
              series: [{
                      name: 'Line 1',
                      data: data,
                      tooltip: {
                          valueDecimals: 2
                      }
                  }, {
                      name: 'Line 2',
                      data: data,
                      tooltip: {
                          valueDecimals: 2
                      }
                  }]
          });
      });

  });
</script>