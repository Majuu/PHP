

    <?php

    // Check existence of id parameter before processing further

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        // Include config file

        require_once 'config.php';

        

        // Prepare a select statement

        $sql = "SELECT * FROM produkty WHERE id = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "i", $param_id);

            

            // Set parameters

            $param_id = trim($_GET["id"]);

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                $result = mysqli_stmt_get_result($stmt);

        

                if(mysqli_num_rows($result) == 1){

                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    

                    // Retrieve individual field value

                    $kategoria_id = $row["kategoria_id"];

                    $nazwa = $row["nazwa"];

                    $opis = $row["opis"];

					$img = $row["img"];
                } else{

                    // URL doesn't contain valid id parameter. Redirect to error page

                    header("location: error.php");

                    exit();

                }

                

            } else{

                echo "Oj! Coś poszło nie tak. Spróbuj ponowniej później.";

            }

        }

         

        // Close statement

        mysqli_stmt_close($stmt);

        

        // Close connection

        mysqli_close($link);

    } else{

        // URL doesn't contain id parameter. Redirect to error page

        header("location: error.php");

        exit();

    }

    ?>

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Pokaż rekord</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

        <style type="text/css">

            .wrapper{

                width: 500px;

                margin: 0 auto;

            }

        </style>

    </head>

    <body>

        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-12">

                        <div class="page-header">

                            <h1>Pokaż rekord</h1>

                        </div>

                        <div class="form-group">

                            <label>kategoria_id</label>

                            <p class="form-control-static"><?php echo $row["kategoria_id"]; ?></p>

                        </div>

                        <div class="form-group">

                            <label>nazwa</label>

                            <p class="form-control-static"><?php echo $row["nazwa"]; ?></p>

                        </div>

                        <div class="form-group">

                            <label>opis</label>

                            <p class="form-control-static"><?php echo $row["opis"]; ?></p>

                        </div>

						<div class="form-group">

                            <label>img</label>

                            <p class="form-control-static"><?php echo $row["img"]; ?></p>

                        </div>
                        <p><a href="kategoria.php" class="btn btn-primary">Wstecz</a></p>

                    </div>

                </div>        

            </div>

        </div>

    </body>

    </html>

