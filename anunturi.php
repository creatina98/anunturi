<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'anuntaccount';
// Create connection
$conn = new mysqli($servername,$username, $password,$dbname );

$query1 = "SELECT * FROM   anunt inner join modelanunt ON anunt.id_anunt=modelanunt.ID";

$imobiliare = [];
if ($result = $conn->query($query1)) {
    while ($row = $result->fetch_assoc()) {
        $imobiliare[] = $row;
    }
} else {
    echo "no result display";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Imobiliare</title>
    <style>


        .navbar-brand{
            font-size: 28px;

        }
        .container{
            font-size: 18px;
        }
        .navbar{
            padding: 0 !important;

        }
        .navbar-nav{
            font-size: 22px;

        }
        body{
            background: url(./img/pic.jpg);
            background-size: cover;

        }
         .nav-item:hover{
            background-color:rgba(0,0,0,0.2);

        }
    </style>
</head>
<body>

<h1 class="text-center text-white m-5">Anunturi</h1>
<div class="container">

    <div class="row">


            <?php
            foreach ($imobiliare as $imobil) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                            <p class="card-text"> <?php echo $imobil ['titlul']; ?> </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"  class="btn btn-sm btn-outline-secondary"><a href="./detalii.php">View</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#">Edit</a></button>
                                    <a href="<?php echo $imobil['pret']; ?>">link bun </a>
                                </div>
                                <small class="text-muted"><?php echo $imobil['pret']; ?> EUR</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
