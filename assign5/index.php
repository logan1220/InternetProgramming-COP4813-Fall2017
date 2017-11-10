<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);

//get file contents
$login_file = fopen("creds.txt", "r");
$login_creds = [];
$i = 0;

while (!feof($login_file)) {
    $line = fgets($login_file);
    $login_creds[$i] =  trim($line);
    $i++;
}
fclose($login_file);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['login_username'] == '') {
        //check if user posted a username
        $errors[] = 'Please enter a username';
    } elseif ($_POST['login_password'] == '') {
        //check if user posted a password
        $errors[] = 'Please enter a password';
    } else {
        //check if posted creds are correct
        if (strtolower($_POST['login_username']) == strtolower($login_creds[0])) {
            if ($_POST['login_password'] == $login_creds[1]) {
                $_SESSION['username'] = $_POST['login_username'];
                header('Location: /~n00895918/cop4813/assign5/admin.php');
            } else {
                $errors[] = 'Password incorrect';
            }
        } else {
            $errors[] = 'Username incorrect';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment 5</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>

</head>
<body>
<a href="../index.html" style="display: block; margin-top: 15px; margin-left: 15px;">Home Page</a>
    <form method="post" action="index.php" id="form" style="width: 100%; margin-top: 10%;">
        <div class='container'>
            <div id='loginbox' class='mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>
                <div class='panel panel-default' >
                    <div class='panel-heading'>
                        <div class='panel-title text-center'>
                            <h6>Login</h6>
                        </div>
                    </div>
                    <div class='panel-body'>
                        <?php if($errors) { ?>
                            <?php foreach ($errors as $error) { ?>
                                <h6><font color="red"><?php echo $error ?></font></h6>
                            <?php } ?>
                        <?php } ?>
                        <div class='input-group'>
                            <span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
                            <input id='login_username' type='text' class='form-control' name='login_username'
                                   value='' placeholder='Logan' onkeypress='keyPress(event)'>
                        </div>
                        <div class='input-group'>
                            <span class='input-group-addon'><i class='glyphicon glyphicon-lock'></i></span>
                            <input id='login_password' type='password' class='form-control' name='login_password'
                                   placeholder='Password' onkeypress='keyPress(event)'>
                        </div>
                        <p align="left"><small><em>*Password is case sensitive.</em></small></p>
                        <div class='form-group text-center'>
                            <!-- Button -->
                            <div class='col-sm-12 controls'>
                                <a onclick='submitForm();' class='btn btn-primary'><i class='glyphicon glyphicon-log-in'></i> Log In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
    function keyPress(e) {
        if (e.keyCode == 13) {
            submitForm();
        }
    }

    function submitForm() {
        $('#form').submit();
    }
</script>

</html>