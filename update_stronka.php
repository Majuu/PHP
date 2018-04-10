

    <?php

    // Include config file

    require_once 'config.php';

     

    // Define variables and initialize with empty values

     $kategoria_id = $nazwa = $opis = $img = "";

     $kategoria_id_err = $nazwa_err = $opis_err = $img_err = "";

     

    // Processing form data when form is submitted

    if(isset($_POST["id"]) && !empty($_POST["id"])){

        // Get hidden input value

        $id = $_POST["id"];

        

        // Validate KATEGORIA_ID

        $input_kategoria_id = trim($_POST["kategoria_id"]);

        if(empty($input_kategoria_id)){

            $kategoria_id_err = "Proszę podać numer kategorii.";

        } elseif(!ctype_digit($input_kategoria_id)){
		
            $kategoria_id_err = 'Proszę wpisać numer kategorii (tylko cyfry).';

        } else{

            $kategoria_id = $input_kategoria_id;

        }

        

        // Validate NAZWA

        $input_nazwa = trim($_POST["nazwa"]);

        if(empty($input_nazwa)){

            $nazwa_err = 'Proszę wpisać nazwę.';     

        } else{

            $nazwa = $input_nazwa;

        }

      
		// Validate OPIS

        $input_opis = trim($_POST["opis"]);

        if(empty($input_opis)){

            $opis_err = 'Proszę dodać opis.';     

        } else{

            $opis = $input_opis;

        }


        // Validate IMG

        $input_img = trim($_POST["img"]);

        if(empty($input_img)){

            $img_err = 'Proszę wpisać nazwę obrazka z bazy.';     

        } else{

            $img = $input_img;

        }

        
        

        // Check input errors before inserting in database

        if(empty($kategoria_id_err) && empty($nazwa_err) && empty($opis_err) && empty($img_err)){

            // Prepare an update statement

            $sql = "UPDATE produkty SET kategoria_id=?, nazwa=?, opis=?, img=? WHERE id=?";

             

            if($stmt = mysqli_prepare($link, $sql)){

                // Bind variables to the prepared statement as parameters

                mysqli_stmt_bind_param($stmt, "ssssi", $param_kategoria_id, $param_nazwa, $param_opis, $param_img, $param_id);

                

                // Set parameters

                $param_kategoria_id = $kategoria_id;

                $param_nazwa = $nazwa;

                $param_opis = $opis;

                $param_img = $img;

                $param_id = $id;

                // Attempt to execute the prepared statement

                if(mysqli_stmt_execute($stmt)){

                    // Records updated successfully. Redirect to landing page

                    header("location: kategoria.php");

                    exit();

                } else{

                    echo "Coś poszło nie tak. Spróbuj ponownie później.";

                }

            }

             

            // Close statement

            mysqli_stmt_close($stmt);

        }

        

        // Close connection

        mysqli_close($link);

    } else{

        // Check existence of id parameter before processing further

        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

            // Get URL parameter

            $id =  trim($_GET["id"]);

            

            // Prepare a select statement

            $sql = "SELECT * FROM produkty WHERE id = ?";

            if($stmt = mysqli_prepare($link, $sql)){

                // Bind variables to the prepared statement as parameters

                mysqli_stmt_bind_param($stmt, "i", $param_id);

                

                // Set parameters

                $param_id = $id;

                

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

                        // URL doesn't contain valid id. Redirect to error page

                        header("location: error.php");

                        exit();

                    }

                    

                } else{

                    echo "Ojej! Coś poszło nie tak. Spróbuj ponownie później.";

                }

            }

            

            // Close statement

            mysqli_stmt_close($stmt);

            

            // Close connection

            mysqli_close($link);

        }  else{

            // URL doesn't contain id parameter. Redirect to error page

            header("location: error.php");

            exit();

        }

    }

    ?>

     

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Zaktualizuj Rekord</title>

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

                            <h2>Zaktualizuj</h2>

                        </div>

                        <p>Proszę zredagować potrzebne okna.</p>

                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">

                                <label>Kategoria</label>

                                <input type="text" name="kategoria_id" class="form-control" value="<?php echo $kategoria_id; ?>">

                                <span class="help-block"><?php echo $kategoria_id_err;?></span>

                            </div>

                            <div class="form-group <?php echo (!empty($nazwa_err)) ? 'has-error' : ''; ?>">

                                <label>Nazwa</label>

                                <textarea name="nazwa" class="form-control"><?php echo $nazwa; ?></textarea>

                                <span class="help-block"><?php echo $nazwa_err;?></span>

                            </div>

                            <div class="form-group <?php echo (!empty($opis_err)) ? 'has-error' : ''; ?>">

                                <label>Opis</label>

                                <input type="text" name="opis" class="form-control" value="<?php echo $opis; ?>">

                                <span class="help-block"><?php echo $opis_err;?></span>

                            </div>

							<div class="form-group <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">

                                <label>Obrazek</label>

                                <input type="text" name="img" class="form-control" value="<?php echo $img; ?>">

                                <span class="help-block"><?php echo $img_err;?></span>

                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                            <input type="submit" class="btn btn-primary" value="Submit">

                            <a href="kategoria.php" class="btn btn-default">Cancel</a>

                        </form>

                    </div>

                </div>        

            </div>

        </div>

    </body>

    </html>

