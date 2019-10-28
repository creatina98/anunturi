<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'anuntaccount';
// Create connection
$conn = new mysqli($servername,$username, $password,$dbname );

$sql = "SELECT nume, valoare FROM imobiliareimplicit
        WHERE nume = 'tipAnunt'
        OR nume = 'compartiment'
        OR nume = 'nrCamere'
        OR nume = 'etaj'
        OR nume = 'nrBai'
        OR nume = 'nrBucatarii'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            switch ($row['nume']) {
                case 'tipAnunt':
                    $tipAnunt = json_decode($row['valoare']);
                    break;
                    case 'compartiment':
                    $compartiment = json_decode($row['valoare']);
                    break;
                    case 'nrCamere':
                    $nrCamere = json_decode($row['valoare']);
                    break;
                    case 'etaj':
                    $etaj = json_decode($row['valoare']);
                    break;
                    case 'nrBai':
                    $nrBai = json_decode($row['valoare']);
                    break;
                    case 'nrBucatarii':
                    $nrBucatarii = json_decode($row['valoare']);
                    break;
            }
        }
    } else {
        echo "0 results";
    }

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $tipAnunt = $_POST['tipAnunt'];
    $titlul = $_POST['titlul'];
    $suprafata = $_POST['suprafata'];
    $compartiment = $_POST['compartiment'];
    $an = $_POST['an'];
    $nrCamere = $_POST['nrCamere'];
    $etaj = $_POST['etaj'];
    $nrBai = $_POST['nrBai'];
    $nrBucatarii = $_POST['nrBucatarii'];
    $pret = $_POST['pret'];

    $sql = "INSERT INTO modelanunt(tipAnunt,titlul,suprafata,compartiment,an,nrCamere,etaj,nrBai,nrBucatarii,pret) VALUES ('{$tipAnunt}','{$titlul}','{$suprafata}','{$compartiment}','{$an}','{$nrCamere}','{$etaj}','{$nrBai}','{$nrBucatarii}','{$pret}')";


    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO  anunt(id_anunt, titlul,pret) VALUES ( '{$last_id}','{$titlul}','{$pret}')"  ;
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully." ;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
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

        .pret1{
            padding: 0 !important;
        }
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
       .container{
          background-color:rgba(0,0,0,.5);

       }
       .nav-item:hover{
          background-color:rgba(0,0,0,0.2);

       }
    </style>
  </head>
  <body>

   <!--bara de navigare-inceput-->

   <nav class="navbar navbar-expand-lg navbar-dark" style="background: #603813;
background: -webkit-linear-gradient(to right, #b29f94, #603813);
background: linear-gradient(to right, #b29f94, #603813);">
   <a class="navbar-brand px-4" href="./index.php">Imobiliare.ro</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
    <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Acasa<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" disabled>Noutati</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./anunturi.php">Anunturi</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Altele
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">ceva1</a>
          <a class="dropdown-item" href="#">ceva2</a>
          <a class="dropdown-item" href="#">ceva2</a>
        </div>
      </li>
    </ul>
  </div>
   </nav>

   <!--bara de navigare-sfarsit-->

   <div class="container text-white">
     <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="https://www.softimobiliar.ro/images/modele-design/modele-design-logo-agentie-imobiliara/imobiliare-04.png" width="120px" width="250px">
      <h2>Adaugă acum anunţul tău</h2>
      <p>Urmează paşii, e mai simplu ca niciodată</p>
      <hr>
     </div>

     <!--row tip si titlul anuntului-->
    <form class="pb-5 text-white" method="post">
     <div class="form-row ">
       <div class="form-group mx-auto text-center " style="width: 250px;">
         <label for="inputAnunt">Tipul anuntului:</label>
         <select name="tipAnunt" id="inputAnunt" class="form-control" >
             <?php
        foreach ($tipAnunt as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>

         </select>
       </div>

       <div class="form-group mx-auto " style="width:950px;">
         <label for="titlul">Titlul Anunt:</label>
         <input type="text" name="titlul" class="form-control" id="inputAnunt" placeholder="Anunt" required>
         <hr>
       </div>
     </div>
     <!--deschis row 2 coloane-->
     <div class="form-row">
     <div class="form-group col-md-4">
       <label for="inputAddress">Suprafata m<sup>2</sup>:</label>
       <input name="suprafata" type="text" class="form-control" id="inputAddress" placeholder="m...">
     </div>
     <div class="form-group col-md-4">
      <label for="inputAnunt">Compartiment:</label>
         <select id="inputAnunt" class="form-control" name="compartiment">
            <?php
        foreach ($compartiment as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>
         </select>
     </div>
     <div class="form-group col-md-4">
      <label for="an">An constructie:</label>
       <input name="an" type="text" class="form-control" id="inputAddress" placeholder="1999...">
     </div>

   </div>
   <!--inchis row 2 coloane-->
   <!--deschis row 3 coloane-->
   <div class="form-row">

      <div class="form-group col-md-3">
        <label for="inputAnunt">Nr Camere:</label>
         <select name="nrCamere" id="inputAnunt" class="form-control">
            <?php
        foreach ($nrCamere as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>
         </select>
      </div>
      <div class="form-group col-md-3">
         <label for="etaj">Etaj:</label>
          <select name="etaj" id="inputAnunt" class="form-control">
            <?php
        foreach ($etaj as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>
          </select>
      </div>
      <div class="form-group col-md-3">
         <label for="inputAnunt">Numar bai:</label>
         <select id="inputAnunt" class="form-control" name="nrBai">
            <?php
        foreach ($nrBai as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>
         </select>

      </div>
      <div class="form-group col-md-3 pret1">
         <label for="inputAnunt">Numar Bucatarii:</label>
          <select id="inputAnunt" class="form-control" name="nrBucatarii">
            <?php
        foreach ($nrBucatarii as $item) {
            ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php
        }
        ?>
         </select>
      </div>
     </div>
     <!--deschis ultimele 3 coloare-->

   <!--inchis row 3 coloane-->

         <div class="form-group col-md-4" style="padding-left: 0px;">
             <label for="pret">Pret:</label>
             <input name = "pret" type="text" class="form-control" id="inputAddress" placeholder="euro">
         </div>
         <div class="form-group">
             <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck">
                 <label class="form-check-label" for="gridCheck">
                     Sunt de acord cu <a href="#">expunerea datelor</a> mele <a href="#">personale</a>.
                 </label>
             </div>
         </div>
     <button name="submit" type="submit" class="btn btn-dark">Adauga</button>
   </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>