<?php
if (!empty($_POST)) {
    $country = $_POST["country"];


    $DATABASE_HOST = "localhost";
    $DATABASE_USER = "root";
    $DATABASE_PASS = "toor";
    $DATABASE_NAME = "ajax";

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $conn->set_charset("utf8");

    $sql = "SELECT city, lat, lng, iso2, iso3, population, admin_name from cities where country = '$country';";
    $stmt = $conn->prepare($sql); //Hace query en el servidor
    //$stmt->bind_param("i", $idNcontrol); //en caso de requerir de usar 'where parametro=id' isuar esta linea para indicar cuales parametros
    $stmt->execute(); //Ejecuta el query
    $result = $stmt->get_result(); // Obtiene el resultado preeliminar del query - NO ES EL RESULTADO FINAL
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Live seach</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <h1>Live search with JQuery</h1>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="col">

                    <div class="search-box">
                        <input class="form-control" type="text" list="datalistOptions" id="exampleDataList" name="country" placeholder="Type to search...">
                        <datalist id="datalistOptions" class="result">
                        </datalist>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">City</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">iso1</th>
                            <th scope="col">iso2</th>
                            <th scope="col">Population</th>
                            <th scope="col">Admin name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($rows)) { ?>
                            <?php for ($i = 0; $i < count($rows); $i++) { ?>
                                <tr>
                                    <td><?= $rows[$i]["city"]; ?></td>
                                    <td><?= $rows[$i]["lat"]; ?></td>
                                    <td><?= $rows[$i]["lng"]; ?></td>
                                    <td><?= $rows[$i]["iso2"]; ?></td>
                                    <td><?= $rows[$i]["iso3"]; ?></td>
                                    <td><?= $rows[$i]["population"]; ?></td>
                                    <td><?= $rows[$i]["admin_name"]; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<!-- BOOTSTRAP 5`JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Scrip for live search -->
<script>
    $(document).ready(function() {
        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("/ajaxrequest.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result option", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

</html>