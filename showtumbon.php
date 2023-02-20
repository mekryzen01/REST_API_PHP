<?php include('./service/db.php');


// if (isset($_REQUEST['search-filter'])) {
//     $text_search = $_REQUEST['text-search'];
//     $select_1 = $db->prepare("SELECT * FROM `watinfo` Where district_id = :district_id ;");
//     $select_1->bindParam(':district_id', $text_search);
//     $select_1->execute();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./components/header_include.php') ?>
    <title>วัดในตำบล</title>
</head>

<body>
    <?php include('./components/nav_user.php') ?>
    <div class="container">
        <div class="row mt-3">
            <div class="" id="show"></div>
        </div>
    </div>

</body>


</html>
<script>
    const parmas = new URLSearchParams(window.location.search)
    const id = parmas.get('district_id')
    console.log(id)

    function loadshowindex() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "http://localhost/Project_REST_api/service/read_watbyidshow.php?district_id=" + id);
        xhttp.send();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var trHTML = '';
                const objects = JSON.parse(this.responseText);
                for (let object of objects) {

                    trHTML += '<div class="col-12 col-md-4 col-lg-4 my-2">';
                    trHTML += '<a href="./watByid.php?id=' + object['id'] + '" id="black">';
                    trHTML += '<div class="card">';
                    trHTML += '<img src="./uploads/' + object['path'] + '"  class="card-img-top" alt="" width="100%" height="200px">';
                    trHTML += '<div class="card-body">';
                    trHTML += '<h5 class="card-title">' + object['wat_name'] + '</h5>';
                    trHTML += '</div>';
                    trHTML += '</div>';
                    trHTML += '</a>';
                    trHTML += '</div>';
                }
                document.getElementById("show").outerHTML = trHTML;
            }
        };
    }
    loadshowindex();
</script>