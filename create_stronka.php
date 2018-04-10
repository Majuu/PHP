

    <?php

    // Include config file

    require_once 'config.php';

     

    // Define variables and initialize with empty values

    $kategoria_id = $nazwa = $opis = $img = "";

    $kategoria_id_err = $nazwa_err = $opis_err = $img_err = "";

     

    // Processing form data when form is submitted

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate KATEGORIA

        $input_kategoria_id = trim($_POST["kategoria_id"]);

        if(empty($input_kategoria_id)){

            $kategoria_id_err = "Proszę podać numer kategorii. ";
        
		} elseif(!ctype_digit($input_kategoria_id)){

        $kategoria_id_err = 'Proszę wpisać odpowiedni numer.';

        } else{

            $kategoria_id = $input_kategoria_id;

        }

        

        // Validate NAZWA

        $input_nazwa = trim($_POST["nazwa"]);

        if(empty($input_nazwa)){

            $nazwa_err = 'Proszę wpisać nazwę. ';     
		
	//	} elseif(!filter_var(trim($_POST["nazwa_id"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
    //        $opis_err = 'Proszę wpisać poprawną nazwę (bez cyfr).';
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

        // Validate img

        $input_img = trim($_POST["img"]);

        if(empty($input_img)){

            $img_err = "Proszę wprowadzić nazwę obrazka z bazy.";     

        } else{

            $img = $input_img;

        }
		
        

        // Check input errors before inserting in database

        if(empty($kategoria_id_err) && empty($nazwa_err) && empty($opis_err) && empty($img_err)){

            // Prepare an insert statement

            $sql = "INSERT INTO produkty (kategoria_id, nazwa, opis, img) VALUES (?, ?, ?, ?)";

             

            if($stmt = mysqli_prepare($link, $sql)){

                // Bind variables to the prepared statement as parameters

                mysqli_stmt_bind_param($stmt, "ssss", $param_kategoriaid, $param_nazwa, $param_opis, $param_img);

                

                // Set parameters
			
				
                $param_kategoriaid = $kategoria_id;

                $param_nazwa = $nazwa;

                $param_opis = $opis;

                $param_img = $img;

				
                // Attempt to execute the prepared statement

                if(mysqli_stmt_execute($stmt)){

                    // Records created successfully. Redirect to landing page

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

    }

    ?>

     

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Stwórz nowy rekord</title>

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

                            <h2>Stwórz rekord</h2>

                        </div>

                        <p>Proszę wypełnić wszystkie okna, aby dodać nowy rekord.</p>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                            <div class="form-group <?php echo (!empty($kategoria_id_err)) ? 'has-error' : ''; ?>">

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

                                <textarea name="img" class="form-control"><?php echo $img; ?></textarea>

                                <span class="help-block"><?php echo $img_err;?></span>

                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">

                            <a href="strona.php" class="btn btn-default">Cancel</a>

                        </form>

                    </div>

                </div>        

            </div>

        </div>

    </body>

    </html>

