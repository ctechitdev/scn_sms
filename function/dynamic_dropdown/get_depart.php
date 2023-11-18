
<?php
include('../../setting/conn.php');

$company_id = $_POST['company_id'];

echo "<option value=''> ເລືອກບໍລິສັດ </option> ";



$stmt = $conn->prepare(" SELECT * FROM tbl_depart where company_id = '$company_id'   ");
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $depart_id = $row['depart_id'];
        $depart_name = $row['depart_name'];
        echo "<option value='$depart_id'>$depart_name</option>";
    }
}


?> 

