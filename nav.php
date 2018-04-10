
<?php
error_reporting(E_ALL ^ E_NOTICE);
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
 // header("location: strona.php");
 // exit;
//}
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
  
	<div class="page-header">
	<h1 style="color:#e6e6e6">German Shepherds </h1>
	</div>
	

	
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="strona.php">Strona glowna</a></li>
       

	   <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie <span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
	
<?php 
$polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_maj');
if (!$polaczenie) {
  die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
}
@mysqli_query($polaczenie, 'SET NAMES utf8');
 
$sql = 'SELECT `id`, `nazwa` 
             FROM `kategorie` 
             ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
  echo "<ul>" . PHP_EOL;
  while (($kategoria = @mysqli_fetch_array($wynik))) {
    echo '<li><a href="' ."kategoria.php". '?kat_id=' . $kategoria['id'] . '">' . $kategoria['nazwa'] . '</a></li>' . PHP_EOL;
  }
  echo "</ul>" . PHP_EOL;
} else {
  echo 'wyników 0';
}
?>

		 </ul> 
        </li>
		
 <li><a href="kontakt.php">Kontakt</a></li>		
      
<li>	  
	  <?php 
	    if(($_SESSION['username']) == 'admin'): ?>
		
		<a href="create_stronka.php" class="btn btn-success pull-right" >Dodaj nową rasę</a>
	   <?php else: ?>
	   <?php endif ?>
	   
</li>	   
	   
	   </ul>     		  
         
<ul class="nav navbar-nav pull-right">
 <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>
 <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
 
 <?php
 
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])): ?>

	<?php else: ?>

<li>
	<h4 style="color:#e6e6e6">Witaj, <b><?php echo $_SESSION['username']; ?></b></h4>
</li>
<li>	
	<p><a href="logout.php" class="btn btn-danger">Wyloguj</a></p>
</li>
	<?php endif ?>
 
 </ul>

    </div>
  </div>
</nav>