<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>
<body>


 <?php include 'nav.php' ;?> 
  
<div class="container">
<?php 

$kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
$sql = 'SELECT `nazwa`, `opis`, `img`, `id` 
             FROM `produkty` 
             WHERE `kategoria_id` = ' . $kat_id .
             ' ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
  while (($produkt = @mysqli_fetch_array($wynik))) {
      echo '<p><b>'. $produkt['nazwa'] . '</b>: ' . $produkt['opis'] . '</p>' . PHP_EOL;
	  echo '<a class="example-image-link" href="img/' . $produkt['img'] . 'd.jpg" data-lightbox="set" data-title="' . $produkt['nazwa'] . '"><img class="example-image" src="img/' . $produkt['img'] . 'm.jpg" alt="image-1" /></a>' . PHP_EOL;

	    if(($_SESSION['username']) == 'admin') {
		
		
		echo "<a href='read_stronka.php?id=". $produkt['id'] ."' title='Pokaż rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";

        echo "<a href='update_stronka.php?id=". $produkt['id'] ."' title='Edytuj rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";

        echo "<a href='delete_stronka.php?id=". $produkt['id'] ."' title='Skasuj rekord' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		}
  }
} else {
  echo 'wyników 0';
}
  
mysqli_close($polaczenie); 
  ?>
  <script src="js/lightbox-plus-jquery.min.js"></script>
 
 <?php include 'stopka.php' ;?>

</body>
</html>
