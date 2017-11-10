<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);

//if user isn't logged in, send them to index.
if(empty($_SESSION['username'])) {
    header('Location: /~n00895918/cop4813/assign5/index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //check if the user wants to logout
    if(!empty($_POST['logout'])) {
        session_destroy();
        header('Location: /~n00895918/cop4813/assign5/index.php');
    }

    //add a stock
    if(!empty($_POST['add_stock']) && !empty($_POST['add_amount'])) {
        $ticker_symbol = strtoupper($_POST['add_stock']);
        $yahoo_csv = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$ticker_symbol&f=sl1d1t1c1ohgv&e=.csv");
        $yahoo_elements = explode(',',$yahoo_csv);
        list($ticker,$current_price,$date,$time,$change,$open_price,$daily_high,$daily_low,$volume) = $yahoo_elements;

        $stock_file = fopen("stocks.txt", "a+");
        fwrite($stock_file,$ticker_symbol .",". $_POST['add_amount'] .",". $current_price .",". time() . "\n");
        $success = 'Successfully added a new stock';
        fclose($stock_file);
    }
    //modify a stock
    if(!empty($_POST['modify_stock']) && !empty($_POST['modify_amount'])) {
        $file_contents = file_get_contents('stocks.txt');
        $separated_contents = array_filter(explode("\n", $file_contents));

        foreach ($separated_contents as $i => $content) {
            list($stock,$count,$price,) = explode(',', $content);

            if ($stock == strtoupper($_POST['modify_stock'])) {
                $separated_contents[$i] = "$stock,{$_POST['modify_amount']},$price,".time();
            }
        }
        file_put_contents('stocks.txt', implode("\n", $separated_contents). "\n");
        $success = "Successfully modified {$_POST['modify_stock']}";
    }
    //delete a stock
    if(!empty($_POST['delete_stock'])) {
        $file_contents = file_get_contents('stocks.txt');
        $separated_contents = array_filter(explode("\n", $file_contents));

        foreach ($separated_contents as $i => $contents) {
            list($stock, $count) = explode(',', $contents);

            if ($stock == strtoupper($_POST['delete_stock'])) {
                unset($separated_contents[$i]);
            }
        }
        file_put_contents('stocks.txt', implode("\n", $separated_contents) . "\n");
        $success = "Successfully deleted {$_POST['delete_stock']}";
    }
}

//get file contents to show portfolio
$stock_data = file_get_contents('stocks.txt');
$stock_data_line = array_filter(explode("\n", $stock_data));
$sum_total = 0;
$sum_current = 0;
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
<form method="post" action="admin.php" id="form" style="width: 100%; margin-top: 0;">
    <div class='container' style="margin-top: 5%;">
        <div id='loginbox' class='mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3'>
            <div class='panel panel-default' >
                <div class='panel-heading'>
                    <div class='panel-title text-center'>
                        <h3>Welcome <?php echo $_SESSION['username']?></h3>
                        <h6>Services</h6>
                    </div>
                </div>
                <div class='panel-body'>
                    <?php if(!empty($success)): ?>
                        <?php echo "<h6 style='color: green;'>$success</h6>"; ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-info" value="Add Stock"
                                   onclick="$('#add').show();$('#delete').hide();$('#modify').hide();">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-info" value="Modify Stock"
                                   onclick="$('#modify').show();$('#delete').hide();$('#add').hide();">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-info" value="Delete Stock"
                                   onclick="$('#delete').show();$('#modify').hide();$('#add').hide();">
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-warning" name="logout" value="Logout">
                        </div>
                    </div>
                </div>
            </div>
            <div class='panel panel-default' id="add" style="display: none;">
                <div class='panel-heading'>
                    <div class='panel-title text-center'>
                        <h4>Add stock</h4>
                    </div>
                </div>
                <div class='panel-body'>
                    <label class="control-label">Ticker Symbol to add:</label>
                    <input type="text" class="form-control" name="add_stock" value="" placeholder="AAPL">
                    <label class="control-label">Number of shares:</label>
                    <input type="text" class="form-control" name="add_amount" value="" placeholder="15">
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
            <div class='panel panel-default' id="modify" style="display: none;">
                <div class='panel-heading'>
                    <div class='panel-title text-center'>
                        <h4>Modify stock</h4>
                    </div>
                </div>
                <div class='panel-body'>
                    <label class="control-label">Ticker Symbol to modify:</label>
                    <input type="text" class="form-control" name="modify_stock" value="" placeholder="AAPL">
                    <label class="control-label">Number of shares:</label>
                    <input type="text" class="form-control" name="modify_amount" value="" placeholder="15">
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </div>
            <div class='panel panel-default' id="delete" style="display: none;">
                <div class='panel-heading'>
                    <div class='panel-title text-center'>
                        <h4>Delete stock</h4>
                    </div>
                </div>
                <div class='panel-body'>
                    <label class="control-label">Ticker Symbol to delete:</label>
                    <input type="text" class="form-control" name="delete_stock" value="" placeholder="AAPL">
                    <br>
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class='panel panel-default'>
                <div class="panel-heading">
                    <h4>Your Stock Portfolio</h4>
                </div>
                <div class="panel-body" style="text-align: left;">
                    <div class="row">
                        <div class="col-sm-1"><b>Ticker Symbol</b></div>
                        <div class="col-sm-1"><b>Shares</b></div>
                        <div class="col-sm-1"><b>Purchased At</b></div>
                        <div class="col-sm-2"><b>Total Share Value</b></div>
                        <div class="col-sm-1"><b>Current Price</b></div>
                        <div class="col-sm-1"><b>Percent Increase</b></div>
                        <div class="col-sm-2"><b>Date Purchased</b></div>
                        <div class="col-sm-2"><b>Total Portfolio Value</b></div>
                    </div>
                    <hr style="width: 100%;">

                    <?php foreach($stock_data_line as $new_line): ?>
                        <?php

                            list($symbol, $shares, $purchased_at, $date) = explode(',', $new_line);
                            $yahoo_csv = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$symbol&f=sl1d1t1c1ohgv&e=.csv");
                            $yahoo_elements = explode(',',$yahoo_csv);
                            list(,$current_price,,,,,,,) = $yahoo_elements;

                            $percent = number_format((float)((($current_price * $shares) - ($purchased_at * $shares)) / ($purchased_at * $shares)) * 100, 2, '.', '');
                            if($percent > 0) {
                                $color = 'green';
                            } else {
                                $color = 'red';
                            }
                            $sum_total += $current_price * $shares;
                            $sum_current += $purchased_at * $shares;

                            if($sum_total > $sum_current) {
                                $color_2 = 'green';
                            } else {
                                $color_2 = 'red';
                            }

                        ?>
                        <div class="row">
                            <div class="col-sm-1"><b><?php echo $symbol ?></b></div>
                            <div class="col-sm-1"><b><?php echo $shares ?></b></div>
                            <div class="col-sm-1"><b>$<?php echo number_format((float)$purchased_at, 2, '.', '') ?></b></div>
                            <div class="col-sm-2"><b>$<?php echo number_format((float)$shares * $purchased_at, 2, '.', '') ?></b></div>
                            <div class="col-sm-1"><b>$<?php echo number_format((float)$current_price, 2, '.', '');?></b></div>
                            <div class="col-sm-1"><b style="color: <?php echo $color ?>"><?php echo $percent?>%</b></div>
                            <div class="col-sm-2"><b><?php echo date('Y/m/d - H:i:s',$date) ?></b></div>
                            <div class="col-sm-2"><b>--</b></div>
                        </div>
                        <br>
                    <?php endforeach; ?>
                    <hr>
                    <div class="row">
                        <div class="col-sm-1"><b>--</b></div>
                        <div class="col-sm-1"><b>--</b></div>
                        <div class="col-sm-1"><b>--</b></div>
                        <div class="col-sm-2"><b>$<?php echo number_format((float)$sum_current, 2, '.', '') ?></b></div>
                        <div class="col-sm-1"><b>--</b></div>
                        <div class="col-sm-1">--</b></div>
                        <div class="col-sm-2"><b>--</b></div>
                        <div class="col-sm-2"><b style="color: <?php echo $color_2?>">$<?php echo number_format((float)$sum_total, 2, '.', '') ?></b></div>
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