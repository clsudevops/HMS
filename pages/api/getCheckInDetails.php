<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $checkInId = $_GET['checkInId'];

    // $select = "Select roomNo, type, floor, rate, rateperhour,
    //  guestId, name, mobile, companyName, companyAddress , DATE_FORMAT(checkIn,'%M %d, %Y') as checkInDate,
    //   DATE_FORMAT(checkIn,'%h:%i:%s %p') As checkInTime, DATE_FORMAT(checkOutDate,'%M %d, %Y') as checkOutDate,
    //    DATE_FORMAT(checkOutDate,'%h:%i:%s %p') As checkOutTime,
    //     (case when now() >= checkOutDate then DATEDIFF(now() , checkIn) else DATEDIFF(now() , checkIn) + 1 End) as noOfDays,
    //      (case when checkOutDate <= now() then Hour(TimeDiff((DATE_FORMAT(now(),'%H:%i:%s')), date_format(DATE_ADD(checkIn, INTERVAL DATEDIFF(now() , checkIn) DAY),'%H:%i:%s'))) else 0 END) as penaltyHours
    //  from checkInDetails
    //  where checkInId = '". $checkInId ."'";

    $select = "Select roomNo, type, floor, rate, rateperhour, guestId, name, mobile, companyName, companyAddress , 
    DATE_FORMAT(checkIn,'%M %d, %Y') as checkInDate,
    DATE_FORMAT(checkIn,'%h:%i:%s %p') As checkInTime,
    DATE_FORMAT(checkOutDate,'%M %d, %Y') as checkOutDate,
    DATE_FORMAT(checkOutDate,'%h:%i:%s %p') As checkOutTime,
    (case when DATEDIFF(DATE_FORMAT(now(),'%Y-%m-%d') , DATE_FORMAT(checkIn,'%Y-%m-%d')) = 0 then 1 else DATEDIFF(DATE_FORMAT(now(),'%Y-%m-%d') , DATE_FORMAT(checkIn,'%Y-%m-%d')) End) as noOfDays,
    (case when checkOutDate <= now() then Hour(TimeDiff((DATE_FORMAT(now(),'%H:%i:%s')), date_format(DATE_ADD(checkIn, INTERVAL DATEDIFF(now() , checkIn) DAY),'%H:%i:%s'))) else 0 END) as penaltyHours
    from checkInDetails where checkInId = '". $checkInId ."'";

    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>