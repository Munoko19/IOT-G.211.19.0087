<!DOCTYPE HTML>
<html>
    <head>

    </head>

    <body>

        <br><br><br>
        <!-- menampilkan grafik dengan id chartContainer -->
        <!-- ukuran grafik: tinggi = 550 piksel, dan maksimal lebar 920 piksel -->
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

        <h2 style="text-align: center">Monitoring Suhu</h2>

        <!-- import libaray canvasjs dan jquery dengan cdn  -->

        <script>
            window.onload = function () {

var options = {
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "jQuery Spline Area Chart"
	},
	data: [
	{
		type: "splineArea",
		dataPoints: [
			{ y: 10 },
			{ y: 6 },
			{ y: 14 },
			{ y: 12 },
			{ y: 19 },
			{ y: 14 },
			{ y: 26 },
			{ y: 10 },
			{ y: 22 }
		]
	}
	]
};
$("#chartContainer").CanvasJSChart(options);

}

                var updateChart = function (count) {
                    // data bitcoin yang digunakan https://api.coindesk.com/v1/bpi/currentprice.json
                    $.getJSON("http://localhost/MQTT-PHP/getdata.php", function (data) {

                        var suhu = data.suhu//mengambil data spesifik rate_float
                        console.log(suhu) //menampilkan data dengan console.log hanya terlihat saat mode inspect element
                        yVal = suhu // mengisi variabel yVal dengan data usd

                        count = count || 1;

                        //melakukan perulangan data dengan for agar data dapat dijalankan
                        for (var j = 0; j < count; j++) {
                            dps.push({
                                x: xVal,
                                y: yVal
                            });
                            xVal++;
                        }

                        //jika datapoints telah melewati datalength
                        if (dps.length > dataLength) {
                            dps.shift(); //maka hapus data awal dengan fungsi shift()
                        }

                    })
                    chart.render();
                };

                //jalankan fungsi updateChart di atas
                updateChart(dataLength);

                //fungsi agar data dapat diupdate setiap 1000 detik sekali
                setInterval(function () {
                    updateChart()
                }, updateInterval);
            

        </script>
    </body>
</html>