<?php
$SERVER = "localhost";
$username ="root";
$password = "";
$database = "demo";
$conn = mysqli_connect($SERVER,$username,$password,$database);
if(!$conn)
{
die( "<script>alert('Concation Falid'); </script>");
}
?>
