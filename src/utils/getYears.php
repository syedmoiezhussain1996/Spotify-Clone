<?php

//function get_years() {
    // Retrieve the start and end years
    $query = "SELECT YEAR(DATE_SUB(CURDATE(), INTERVAL 100 YEAR)) AS start_year, YEAR(CURDATE()) AS end_year";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $start_year = $row['start_year'];
    $end_year = $row['end_year'];
    
    // Generate a list of years between the start and end years
    $years = array();
    for ($year = $start_year; $year <= $end_year; $year++) {
      $years[] = $year;
    }
      //echo json_encode($years);

 // }
// Connect to the database




// Print the list of years
// print_r($years);


