<?php
$sql = 'SELECT * FROM users ORDER BY ID';
$result =mysqli_query($mysqli,$sql);
$rows = mysqli_num_rows($result);

for($z = 0; $z < $rows; $z++) {
$uid[$z] = db_result($result,$z,"ID");
$uname[$z] = db_result($result,$z,"USERNAME");
$uemail[$z] = db_result($result,$z,"EMAIL");
$urank[$z] = db_result($result,$z,"RANK");
}
?>
