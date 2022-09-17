<?php
include 'config.php';
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
    
    $Mangerid = $_POST['Mangerid'];
    $_SESSION['Mangerid'] = $Mangerid;
    $MangerPassword =$_POST['MangerPassword'];
    $sqlCheck = "SELECT * FROM mangers WHERE MangerID = '$Mangerid' and Password = '$MangerPassword'";
    $SELECTALL = mysqli_query($conn,"SELECT * FROM mangers WHERE MangerID = '$Mangerid' and Password = '$MangerPassword'");
    while($row = mysqli_fetch_array($SELECTALL))
    {
      $level =  $row['level'];
    }
    $result = mysqli_query($conn,$sqlCheck);
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $phone = "";
            $password = "";
            if($level==1)
            {
                header("location: admin.php");
            }
            else
            {
                header("location: home.php");
            }
        }
        else
        {
            echo  "<script>alert('User does not  exist')</script>";
        }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type='text/javascript' src='/jQuery/js.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
    <Div class="container-fluid-width">

        <div class="contanier" style="margin-top: 150px;">
            <div class="row" style="justify-content: center;">
                <div class="col-12 col-md-6 col-sm-9 col-lg-5 col-xl-4">
                    <div class="card-login">
                        <form method="post" action="#">
                        <div class="row login-row" >
                            <div class="col-12">
                                <h4>Login To Our Site</h4>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-12 box-felid">
                               <input type="text" name="Mangerid" placeholder="Manger id"   value="<?php echo ($_POST['Mangerid'])?>">
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-12 box-felid">
                               <input type="password" name="MangerPassword" placeholder="MangerPassword"   value="<?php echo $_POST['MangerPassword'];?>">
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-12 box-felid">
                            <button name="submit" type="submit" class="btn btn-secondary">Login</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </Div>
</head>

<body>

</body>

</html>