<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://maps.googleapis.com/maps/api/js?key=You_KEY_APi&callback=initMap" async defer></script>
  
    <?php include('./components/header_include.php') ?>
    <link rel="stylesheet" href="./css/page.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>วัด</title>
</head>

<body>
    <?php include('./components/nav_user.php') ?>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <h1 id="namewat"></h1>
        </div>
        <div class="row justify-content-center">
            <p id="detail"></p>
        </div>
        <div class="row justify-content-center">
            <p id="address"></p>
        </div>
        <div class="row">
            <div class="" id="gimage"></div>
        </div>

        <div id="map" style="height: 400px;" class="my-3"></div>
    </div>
</body>

</html>
<script>
    const url_params = new URLSearchParams(window.location.search)
    const idwat = url_params.get('id')
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost/Project_REST_api/service/read_watbyid.php?id=" + idwat, requestOptions)
        .then(response => response.text())
        .then(result => {
            var jsonget = JSON.parse(result)
            document.getElementById('namewat').innerHTML = jsonget.wat_name
            document.getElementById('detail').innerHTML = jsonget.detail
        })
        .catch(error => console.log('error', error));

    function initMap(latitude, longitude) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', "http://localhost/Project_REST_api/service/read_watbyid.php?id=" + idwat);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const arraydata = Object.values(data)
                console.log(arraydata)
                const map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: parseFloat(arraydata[6]),
                        lng: parseFloat(arraydata[7])
                    },
                    zoom: 16,
                });
                arraydata.forEach(location => {
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(arraydata[6]),
                            lng: parseFloat(arraydata[7])
                        },
                        map: map,
                        title: location[5],
                    });
                })
            } else {
                console.error(xhr.statusText);
            }
        };
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                initMap(latitude, longitude);
            }, function() {
                // handle errors here
            });
        } else {
            // handle unsupported browser
        }
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send();
    }

    function gellryewat() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "http://localhost/Project_REST_api/service/read_imagebyid.php?id=" + idwat)
        xhttp.send()
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                var trHTML = ''
                const data = JSON.parse(this.responseText)
                for (let object of data) {
                    trHTML += '<div class="col-12 col-md-4 col-lg-4 my-2 ">';
                    trHTML += '<div class="card">';
                    trHTML += '<img src="./uploads/' + object['path'] + '"  class="card-img-top" alt="" width="100%" height="200px">';
                    trHTML += '</div>';
                    trHTML += '</div>';
                }
                document.getElementById("gimage").outerHTML = trHTML;
            }
        }
    }
    gellryewat();
</script>
