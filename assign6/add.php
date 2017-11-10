<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 4:17 PM
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('db_connection.php');

    $stmt = $dbh->prepare('INSERT INTO 
    `jobs` (`company_name`,`job_title`,`salary`,`education`,`experience`,`programming_language`)
    VALUES (?,?,?,?,?,?)');

    $stmt->execute([
        $_POST['company_name'],
        $_POST['job_title'],
        $_POST['salary'],
        $_POST['education'],
        $_POST['experience'],
        implode(',',$_POST['programming_language']),
    ]);

    //go back to main page
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment 5</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
</head>
    <body>
        <form method="post" action="add.php" id="form" style="width: 100%; margin-top: 0;">
            <div class='container' style="margin-top: 5%; font-family: Arial;">
                <div id='loginbox' class='mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <div class='panel-title text-center'>
                                <h4>Add Listing</h4>
                            </div>
                        </div>
                        <div class='panel-body'>
                            <label class="control-label">Name of Company:</label>
                            <input type="text" class="form-control" name="company_name" value=""
                                   placeholder="Apple">
                            <label class="control-label">Job Title</label>
                            <input type="text" class="form-control" name="job_title" value=""
                                   placeholder="Senior Swift Developer">
                            <label class="control-label">Starting Salary:</label>
                            <select class="form-control" name="salary">
                                <option value="">--Select One--</option>
                                <option value="10000">$10,000</option>
                                <option value="20000">$20,000</option>
                                <option value="30000">$30,000</option>
                                <option value="40000">$40,000</option>
                                <option value="50000">$50,000</option>
                                <option value="60000">$60,000</option>
                                <option value="70000">$70,000</option>
                                <option value="80000">$80,000</option>
                                <option value="90000">$90,000</option>
                                <option value="100000">$100,000</option>
                            </select>
                            <label class="control-label">Education Requirements:</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="education" value="None">None
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="education" value="A.A./A.S.">A.A./A.S.
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="education" value="B.A./B.S.">B.A./B.S.
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="education" value="M.A.">M.A.
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="education" value="PhD.">PhD.
                            </label>
                            <br><br>
                            <label class="control-label">Workforce Experience</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="0">None
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="1">1 Year
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="2.">2 Years
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="3">3 Years
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="4">4 Years
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" value="5">5 Years
                            </label>
                            <br><br>
                            <label class="control-label">Programming Language:</label>
                            <br>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="programming_language[]" value="PHP/MySQL">PHP/MySQL
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="programming_language[]" value="Swift">Swift
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="programming_language[]" value="C#/.NET/MsSQL ">C#/.NET/MsSQL
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="programming_language[]" value="C++">C++
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="programming_language[]" value="Java">Java
                            </label>
                            <br><br>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>