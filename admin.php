<?php
include 'config.php';
session_start();
$MANGERSYSTEM =  $_SESSION['Mangerid'];
$RemoveManger = '';
$MangerNameAdd = '';
$MangerIDAdd = '';
$id = '';
$name = '';
$address = '';
$manger = 'Cyxdak1ng';
$cnt = mysqli_query($conn, "SELECT COUNT(*) as cnt from student");
$res = mysqli_query($conn, "SELECT * from student");
$mangers = mysqli_query($conn, "SELECT *from mangers where level = '1' and mangerID = '$MANGERSYSTEM'");
$mangertable =  mysqli_query($conn, "SELECT distinct(MangerID) , MangerName from mangers");
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['address'])) {
    $address = $_POST['address'];
}
if (isset($_POST['RemoveManger'])) {
    $RemoveManger = $_POST['RemoveManger'];
}
if (isset($_POST['MangerIDAdd'])) {
    $MangerIDAdd = $_POST['MangerIDAdd'];
}
if (isset($_POST['MangerNameAdd'])) {
    $MangerNameAdd = $_POST['MangerNameAdd'];
}
if (isset($_POST['MangerLevel'])) {
    $MangerLevel = $_POST['MangerLevel'];
}


$sqls = '';
if (isset($_POST['add'])) {
    if (!empty($MangerNameAdd) && !empty($MangerIDAdd)) {
        $sqls = "INSERT INTO mangers VALUE('$MangerIDAdd','$MangerNameAdd','123','$MangerLevel')";
        mysqli_query($conn, $sqls);
        header("location: admin.php");
    } else {
        $MANGERSYSTEM =  $_SESSION['Mangerid'];
        $sqls = "INSERT INTO STUDENT VALUE($id,'$name','$address','$MANGERSYSTEM')";
        mysqli_query($conn, $sqls);
        header("location: admin.php");
    }
}
if (isset($_POST['remove'])) {
    if (!empty($RemoveManger)) {
        $sqls = "delete from mangers where MangerId ='$RemoveManger'";
        mysqli_query($conn, $sqls);
        header("location: admin.php");
    } else if (!empty($name)) {
        $sqls = "delete from student where name ='$name'";
        mysqli_query($conn, $sqls);
        header("location: admin.php");
    } else {
        $sqls = "delete from student where id ='$id'";
        mysqli_query($conn, $sqls);
        header("location: admin.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type='text/javascript' src='/jQuery/js.js'></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<body>
    <div class="container-fluid-width">
        <!-- Header -->
        <div class="row" style="background-color:orange ; border-bottom: 1px solid black;">

            <div class="col-12">
                <div class="row" id="HeaderRow">
                    <div class="col-lg-2 col-md-1 col-sm-2 col-xl-2" id="hideonsmall" style="margin-top:10px">
                        <h6>Students :<?php while ($row = mysqli_fetch_array($cnt)) {
                                            echo $row['cnt'];
                                        } ?> </h6>
                    </div>
                    <section class="top-nav" id="hideonbig" style="z-index:9999 ;">
                        <input id="menu-toggle" type="checkbox" />
                        <label class='menu-button-container' for="menu-toggle">
                            <div class='menu-button'></div>
                        </label>
                        <ul class="menu">
                            <li>
                                <a href="Packages.html" class="nav-link">A<span id="line"></span></a>
                            </li>
                        </ul>
                    </section>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-5" id="hideonsmall">
                        <ul style="margin-top:10px">
                            <li>
                                <a style="font-weight: bolder;"" class=" nav-link">Student Manger System</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-0 col-sm-2 col-xl-3" style="display:flex ; align-items: center;">
                        <a id="hideonsmall">
                            <?php
                            while ($row = mysqli_fetch_array($mangers)) {
                                echo "Welcome Back! :" . $row['MangerName'];
                                break;
                            }

                            ?>
                        </a>
                        <a style="margin-left: 30px ;" href="Login.php" id="hideonsmall">
                            LogOut
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="#">
            <div class="row" style="justify-content: space-around ;">
                <div class="col-lg-8">
                    <table class="table table-dark" id="tbl">
                        <thead style="border-bottom: 2px solid lightblue;">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">MangerName</th>
                                <th scope="col">MangerID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($res)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                while ($row = mysqli_fetch_array($mangertable)) {
                                    echo "<td>" . $row['MangerName'] . "</td>";
                                    echo "<td>" . $row['MangerID'] . "</td>";
                                    break;
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3 col-xl-4 col-sm-4 col-12" style="display: flex; justify-content: center; margin-top: 30px;">
                    <aside>
                        <h3>Manger Panel</h3>
                        <label>Student ID</label><br>
                        <input type="text" name='id' id="id"><br>
                        <label>Student Name</label><br>
                        <input type="text" name="name" id="name"><br>
                        <label>Student Address</label><br>
                        <input type="text" name="address" id="address"><br>
                        <label>Add Manger</label><br>
                        <input type="text" name="MangerNameAdd" id="MangerNameAdd" placeholder="MangerName"><br>
                        <input type="text" name="MangerIDAdd" id="MangerIDAdd" placeholder="MangerID"><br>
                        <input type="text" name="MangerLevel" id="MangerLevel" placeholder="MangerLevel"><br>
                        <label>Remove Manger</label><br>
                        <input type="text" name="RemoveManger" id="RemoveManger">
                        <div class="row" style="margin-top:20px  ;">
                            <div class="col-6">
                                <button type="submit" name="add" class="btn btn-success">Add</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" name="remove" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </form>

    </div>
</body>

</html>