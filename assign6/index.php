<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 2:08 PM
 */

require('db_connection.php');

$sql= "SELECT * FROM `jobs`";
$stmt = $dbh->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment 6</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>
<body style="font-family: Arial;">
<a href="../index.html" style="display: block; margin-top: 15px; margin-left: 15px;">Home Page</a>
<a href="ERD.png" style="display: block; margin-top: 15px; margin-left: 15px;">ER Diagram</a>
    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: left;">
                        <b>Job Listings:</b>
                    </div>
                    <div class="panel-body" style="text-align: left;">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="add.php">
                                    <input class="btn btn-primary" value="Create new listing">
                                </a>
                            </div>
                        </div>
                        <br>
                        <table id="jobs" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Job Title</th>
                                    <th>Base Salary</th>
                                    <th>Education Requirements</th>
                                    <th>Field Experience</th>
                                    <th>Programming Language</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($stmt->fetchAll() as $row): ?>
                                    <tr>
                                        <td><?php echo $row['company_name'];?></td>
                                        <td><?php echo $row['job_title'];?></td>
                                        <td>$<?php echo $row['salary'];?></td>
                                        <td><?php echo $row['education'];?></td>
                                        <td><?php echo $row['experience'];?> yr</td>
                                        <td><?php echo $row['programming_language'];?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-xs btn-warning">Edit</button>
                                            </a>
                                            <a href="delete.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-xs btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {
        $('#jobs').DataTable();
    } );
</script>
</body>
</html>
