

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Dashboard</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

        <style type="text/css">

            .wrapper{

                width: 650px;

                margin: 0 auto;

            }

            .page-header h2{

                margin-top: 0;

            }

            table tr td:last-child a{

                margin-right: 15px;

            }

        </style>

        <script type="text/javascript">

            $(document).ready(function(){

                $('[data-toggle="tooltip"]').tooltip();   

            });

        </script>

    </head>

    <body>

        <div class="wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-12">

                        <div class="page-header clearfix">

                            <h2 class="pull-left">Rasy zwierząt</h2>

                            <a href="create_stronka.php" class="btn btn-success pull-right">Dodaj nową rasę</a>

                        </div>

                        <?php

                        // Include config file

                        require_once 'config.php';

                        

                        // Attempt select query execution

                        $sql = "SELECT * FROM produkty";

                        if($result = mysqli_query($link, $sql)){

                            if(mysqli_num_rows($result) > 0){

                                echo "<table class='table table-bordered table-striped'>";

                                    echo "<thead>";

                                        echo "<tr>";

                                            echo "<th>Id</th>";

                                            echo "<th>Kategoria</th>";

                                            echo "<th>Nazwa</th>";

                                            echo "<th>Opis</th>";
											
											echo "<th>Obrazek</th>";

                                            echo "<th>Akcja</th>";

                                        echo "</tr>";

                                    echo "</thead>";

                                    echo "<tbody>";

                                    while($row = mysqli_fetch_array($result)){

                                        echo "<tr>";

                                            echo "<td>" . $row['id'] . "</td>";

                                            echo "<td>" . $row['kategoria_id'] . "</td>";

                                            echo "<td>" . $row['nazwa'] . "</td>";

                                            echo "<td>" . $row['opis'] . "</td>";
											
											echo "<td>" . $row['img'] . "</td>";

                                            echo "<td>";

                                                echo "<a href='read_stronka.php?id=". $row['id'] ."' title='Pokaż rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";

                                                echo "<a href='update_stronka.php?id=". $row['id'] ."' title='Edytuj rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";

                                                echo "<a href='delete_stronka.php?id=". $row['id'] ."' title='Skasuj rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                                            echo "</td>";

                                        echo "</tr>";

                                    }

                                    echo "</tbody>";                            

                                echo "</table>";

                                // Free result set

                                mysqli_free_result($result);

                            } else{

                                echo "<p class='lead'><em>Nie ma żadnych wpisów.</em></p>";

                            }

                        } else{

                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

                        }

     

                        // Close connection

                        mysqli_close($link);

                        ?>

                    </div>

                </div>        

            </div>

        </div>

    </body>

    </html>

