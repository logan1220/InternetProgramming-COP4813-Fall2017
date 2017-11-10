<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 4:17 PM
 */

require('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $dbh->prepare('UPDATE `jobs` 
    SET `company_name` = ?,`job_title` = ?,`salary` = ?,`education` = ?,`experience` = ?,`programming_language` = ?
    WHERE `id` = ?');

    $stmt->execute([
        $_POST['company_name'],
        $_POST['job_title'],
        $_POST['salary'],
        $_POST['education'],
        $_POST['experience'],
        implode(',',$_POST['programming_language']),
        $_POST['id'],
    ]);

    //go back to main page
    header('Location: index.php');
} else {
    $stmt = $dbh->prepare('SELECT * FROM `jobs` WHERE `id` = ?');
    $stmt->execute([$_GET['id']]);
    $data = $stmt->fetch();

    $pl = explode(',',$data['programming_language']);

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
<form method="post" action="edit.php" id="form" style="width: 100%; margin-top: 0;">
    <div class='container' style="margin-top: 5%; font-family: Arial;">
        <div id='loginbox' class='mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <div class='panel-title text-center'>
                        <h4>Edit Listing</h4>
                    </div>
                </div>
                <div class='panel-body'>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <label class="control-label">Name of Company:</label>
                    <input type="text" class="form-control" name="company_name"
                           value="<?php echo $data['company_name'] ?>">
                    <label class="control-label">Job Title</label>
                    <input type="text" class="form-control" name="job_title"
                           value="<?php echo $data['job_title'] ?>">
                    <label class="control-label">Starting Salary:</label>
                    <select class="form-control" name="salary">
                        <option value="">--Select One--</option>
                        <option value="10000"
                            <?php if($data['salary'] == '10000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$10,000
                        </option>
                        <option value="20000"
                            <?php if($data['salary'] == '20000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$20,000
                        </option>
                        <option value="30000"
                            <?php if($data['salary'] == '30000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$30,000
                        </option>
                        <option value="40000"
                            <?php if($data['salary'] == '40000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$40,000
                        </option>
                        <option value="50000"
                            <?php if($data['salary'] == '50000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$50,000
                        </option>
                        <option value="60000"
                            <?php if($data['salary'] == '60000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$60,000
                        </option>
                        <option value="70000"
                            <?php if($data['salary'] == '70000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$70,000
                        </option>
                        <option value="80000"
                            <?php if($data['salary'] == '80000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$80,000
                        </option>
                        <option value="90000"
                            <?php if($data['salary'] == '90000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?>>$90,000
                        </option>
                        <option value="100000"
                            <?php if($data['salary'] == '100000'):?>
                                <?php echo 'selected'?>
                            <?php endif;?> >$100,000
                        </option>
                    </select>
                    <label class="control-label">Education Requirements:</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="education" value="None"
                            <?php if($data['education'] == 'None'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>None
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="education" value="A.A./A.S."
                            <?php if($data['education'] == 'A.A./A.S.'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>A.A./A.S.
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="education" value="B.A./B.S."
                            <?php if($data['education'] == 'B.A./B.S.'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>B.A./B.S.
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="education" value="M.A."
                            <?php if($data['education'] == 'M.A.'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>M.A.
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="education" value="PhD."
                            <?php if($data['education'] == 'PhD.'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>PhD.
                    </label>
                    <br><br>
                    <label class="control-label">Workforce Experience:</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="0"
                            <?php if($data['experience'] == '0'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>None
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="1"
                            <?php if($data['experience'] == '1'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>1 Year
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="2."
                            <?php if($data['experience'] == '2'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>2 Years
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="3"
                            <?php if($data['experience'] == '3'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>3 Years
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="4"
                            <?php if($data['experience'] == '4'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>4 Years
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="experience" value="5"
                            <?php if($data['experience'] == '5'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>>5 Years
                    </label>
                    <br><br>
                    <label class="control-label">Programming Language:</label>
                    <br>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="programming_language[]" value="PHP/MySQL"
                        <?php foreach($pl as $language): ?>
                            <?php if($language == 'PHP/MySQL'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>
                        <?php endforeach; ?>>PHP/MySQL
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="programming_language[]" value="Swift"
                        <?php foreach($pl as $language): ?>
                            <?php if($language == 'Swift'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>
                        <?php endforeach; ?>>Swift
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="programming_language[]" value="C#/.NET/MsSQL"
                        <?php foreach($pl as $language): ?>
                            <?php if($language == 'C#/.NET/MsSQL'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>
                        <?php endforeach; ?>>C#/.NET/MsSQL
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="programming_language[]" value="C++"
                        <?php foreach($pl as $language): ?>
                            <?php if($language == 'C++'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>
                        <?php endforeach; ?>>C++
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="programming_language[]" value="Java"
                        <?php foreach($pl as $language): ?>
                            <?php if($language == 'Java'):?>
                                <?php echo 'checked'?>
                            <?php endif;?>
                        <?php endforeach; ?>>Java
                    </label>
                    <br><br>
                    <input type="submit" class="btn btn-success" value="Update">
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
