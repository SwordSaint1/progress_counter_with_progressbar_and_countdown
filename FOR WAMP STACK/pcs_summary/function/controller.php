<?php
    require 'conn.php';
    $method = $_POST['method'];
    if($method == 'fetch_progress_live'){
        $carmodel = $_POST['carmodel'];
        // $date_plan = $_POST['date_plan'];
        $shift = $_POST['shift'];
        $c = 0;

        if($shift == 'DS'){
            $date_time_start =  $server_date.' '.'08:00:00';
            $date_time_end = $server_date.' '.'19:59:59';
         }
        if($shift == 'NS'){
            $date_time_start =  $server_date.' '.'20:00:00';
            // ADDITIONAL 1 DAY
            $date_time_end_add = (strtotime($server_date) + (3600*24));
            // FORMAT TO DATE
            $date_time_end = date("Y-m-d",$date_time_end_add).' '.'08:00:00';
         }

        $fetch_live = "SELECT Carmodel, Line,IRCS_Line, Target, Actual_Target, Remaining_Target,is_paused FROM pcs_plan WHERE Status = 'Pending' AND Carmodel LIKE '$carmodel%' AND (datetime_DB >='$date_time_start' AND datetime_DB <= '$date_time_end') ORDER BY ID DESC";
        $stmt = $conn->prepare($fetch_live);
        $stmt->execute();
        if($stmt->rowCount()>0){
            foreach($stmt->fetchALL() as $x){
                $c++;

                if($x['is_paused'] === 'YES'){
                    $color = '#e0e0e0 grey lighten-2';
                }

                if($x['Actual_Target'] >= $x['Target']){
                    $diff_color = 'green-text';
                }else{
                    $diff_color = 'red-text';
                }

                echo '<tr class="'.$color.'">';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['Carmodel'].'</td>';
                echo '<td>'.$x['Line'].'</td>';
                echo '<td>'.$x['IRCS_Line'].'</td>';
                echo '<td style="font-weight:bold;font-size:20px;">'.$x['Target'].'</td>';
                echo '<td style="font-weight:bold;font-size:20px;">'.$x['Actual_Target'].'</td>';
                echo '<td class="'.$diff_color.'" style="font-weight:bold;font-size:20px;">'.$x['Remaining_Target'].'</td>';
                echo '</tr>';
            }
        }
    }
?>