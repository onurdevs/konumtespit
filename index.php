<!doctype html>
<html lang="en">
<head>
    <base href="https://onurer.com.tr/deprem/" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acil Durum Konum Bildirimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-4">
            <button id="save-btn" type="button" class="btn btn-primary btn-lg form-control">Konumu Bildir, Yardım Talep Et</button>
        </div>
    </div>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=<DATABASENAME>;charset=utf8", "<DATABASE_USERNAME>", "<DATABASE_PASSWORD>");
    $query = $pdo->query("SELECT * FROM location", PDO::FETCH_ASSOC);
    $data = $query->fetchAll();


    ?>
    <div class="row">
        <div class="col-md">
            <h1>Bildirilen Talepler</h1>
            <p class="lead">Sadece konumunun bilinmesini isteyenler kullansın. Amacım enkaz altındakilerin şarjı bitiyor iletişimi kesiliyor en azından konumlarını buraya kaydetmiş olsunlar ki yetkililere iletebilelim.</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>IP Adresi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            /*foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['latitude'] . "</td>";
                                echo "<td>" . $row['longitude'] . "</td>";
                                echo "<td>" . $row['ip'] . "</td>";
                                echo "</tr>";
                            }*/

                        ?>
                        <td colspan="3">Koordinatlar sadece Afad, Emniyet gibi kurumlarla paylaşılacaktır.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
        $("#save-btn").click(function() {
            // Get user's location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Get user's IP address
                    $.getJSON("https://api.ipify.org?format=json", function(data) {
                        var ip = data.ip;

                        // Send the data to the server
                        $.ajax({
                            url: "write.php",
                            type: "POST",
                            data: {latitude: latitude, longitude: longitude, ip: ip},
                            success: function(result) {
                                alert(result);
                                location.reload();
                            }
                        });
                    });
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });


</script>
</body>
</html>