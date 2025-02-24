<?php
function logActivity($conn, $activity) {
    $timestamp = date("Y-m-d H:i:s");
    $sql = "INSERT INTO recent_activity (activity, timestamp) VALUES ('$activity', '$timestamp')";
    mysqli_query($conn, $sql);
}
?>
