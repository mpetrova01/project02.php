<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Traffic Lights</title>
    </head>
    <body >
    	<header>
    			<h1 align="center">
    				Traffic Lights
    			</h1>
    	</header>
    	<link rel="stylesheet" type="text/css" href="style.css">
        <ul>
              <li><a class="active" href="lights.php">1</a></li>
              <li><a href="calculate1.php">2</a></li>
              <li><a href="calculate2.php">3</a></li>
              <li><a href="calculate3.php">4</a></li>
              <li><a href="calculate4.php">5</a></li>
          </ul>
    </body>
</html>

<?php
if (!empty($_POST["trafficLight"])) {

            // if array empty
            foreach ($_POST["trafficLight"] as $key => $arra) {
                //echo $key + 1 . ' || ';
                foreach ($arra as $value) {
                    if (empty($value)) {
                        header("Location: calculate1.php");
                    } //else {
                        //echo $value . ' | ';
                    //}
                }
                echo '<br>';
            }
            echo '<br>';

            $roadMap = $_POST["trafficLight"];

            echo 'Total time (s): ' . trafficLights($roadMap);
            //echo '<hr>';
        } //else {
            //echo 'Fields are required!' . '<br>';
        //}

        function trafficLights($roadMap) {
            $position = 0;
            $total = 0;
            foreach ($roadMap as $ar) {
                // can not be negative
                if ($ar[0] < 1) {
                    return 'Invalid data!';
                }
                if ($ar[1] < 1) {
                    return 'Invalid data!';
                }

                $switch_count_in_position = floor($ar[0] / $ar[1]);
                $residue = $ar[0] % $ar[1];
                // calculate where is green
                if ($switch_count_in_position % 2 == 0) {
                    $to_green = 0;
                } else {
                    $to_green = $ar[1] - $residue;
                }
                // calculate delay  for each next
                if ($position == 0) {

                    $position = $ar[0];
                    $new_position = $position;
                } else {
                    // can not be negative
                    if ($ar[0] < $position) {
                        return 'Invalid data!';
                    }
                    $new_position = $ar[0] - $position;
                    $position = $ar[0];
                }
                $total += $new_position + $to_green;
            }
            return $total;
        }
?>
          <p>
          	Въведете дължината на пътя и продъжителността на светофара.
          </p>
          <p>
          	В този случай имате два светофара.
          </p>
          
<form  method="post" >
           1: <br>
            <input type="number" name="trafficLight[0][]" value="" placeholder="distance" ><br>
            <input type="number" name="trafficLight[0][]" value="" placeholder="frequency"><br>
           2: <br>
            <input type="number" name="trafficLight[1][]" value="" placeholder="distance"><br>
            <input type="number" name="trafficLight[1][]" value="" placeholder="frequency"><br>
            <br>
            <input type="submit" value="Calculate">
        </form>
