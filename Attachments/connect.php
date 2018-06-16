<!DOCTYPE html>

<html>
    <head>
  <title> INSERT DATA </title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
      <form action="" method="post">
	<table width="600" height="200" border="1">
	<tr>
	<td colspan="3">TeamTime</td>
	</tr>
	<tr>
	<td></td>
	<td>Hourly Salary</td>
	<td>FTE per Activation</td>

	</tr>
	
	<tr>
	<td width="69">RN - ED </td>
	<td>  $<input type="text" name="rntt_HS"> </td> 
	<td>	$<input type="text" name="rntt_FTE"> </td> <br><br>
	</tr>
	
	<tr>
	<td width="169">Lab - all staff </td>
	<td>  $<input type="text" name="ltt_HS">  </td> 
	<td> $<input type="text" name="ltt_FTE"> </td> <br><br>
	</tr>
	
	<tr>
	<td width="169">Radiology - all staff</td>
	<td>  $<input type="text" name="ratt_HS" > </td> 
	<td>$<input type="text" name="ratt_FTE"> </td> <br><br>
	</tr>
	
	<tr>
	<td width="169">Respiratory Therapy - all staff	</td>
	<td>  $<input type="text" name="rett_HS">  </td>
	<td>$<input type="text" name="rett_FTE"> </td> <br><br>
	</tr>
	
	<tr>
	<td width="169">House Supervisor	</td>
	<td>  $<input type="text" name="htt_HS">  </td>
	<td> $<input type="text" name="htt_FTE"> </td> <br><br>
	</tr>
	
	<tr>
	<td width="169">EVS - all staff	</td>
	<td> $<input type="text" name="ett_HS">  </td>
	<td>$<input type="text" name="ett_FTE"> </td><br><br>
	</tr>
	
	<tr>
	<td >OR Management	</td>
	<td>$<input type="text" name="mtt_HS"></td>  
	<td>$<input type="text" name="mtt_FTE"> </td> <br><br>

	</tr>
	
	<tr>
	<td colspan="2">Typical amount of time staff spend on each trauma activation			
<input type="text" name="activation"></td>
	
	</tr>
	
	<tr>
	<td colspan="2">Total Trauma Activations Per Year<input type="text" name="ttapy"></td>
	
	</tr>
	

	</table>
	<input type="submit" name="submit" value="submit">
	
	
	<table>
	<tr>
	<td>Input your hospital's benefit premium (typically 20=30%)</td>
	<td><input type="text" name="benifit"></td>
	</tr>
	
	<tr>
	<td>Percentage of Trauma Patients with uncollectable fees </td>
	<td><input type="text" name="uncollect"></td>
	</tr>
	
	<tr>
	<td>Margin that your facility expects to receive for Trauma services</td>
	<td><input type="text" name="facility"></td>
	</tr>
	
	</table>
	
	</form>
	
           </body>

</html>

<?php

if(isset($_POST['submit']))
{

$user = 'root';
$password = '';
$db = 'company';


$db1 = new mysqli('localhost', $user , $password, $db) or die("Unable 2 connect");
if ($db1->connect_error) {
    die("Connection failed: " . $db1->connect_error);
} 

    
    // get values form input text and number
	
	 $activation= $_POST['activation'];
	$ttapy= $_POST['ttapy'];

    $rntt_HS= $_POST['rntt_HS'];
   $rntt_FTE= $_POST['rntt_FTE'];
	$tota01= $rntt_HS * $rntt_FTE;
  
	
	$ltt_FTE= $_POST['ltt_FTE'];
    $ltt_HS= $_POST['ltt_HS'];
	$tota02= $ltt_HS * $ltt_FTE;

	
	$ratt_FTE= $_POST['ratt_FTE'];
    $ratt_HS= $_POST['ratt_HS'];
	$tota03=$ratt_FTE * $ratt_HS;
	
	$rett_FTE= $_POST['rett_FTE'];
    $rett_HS= $_POST['rett_HS'];
	$tota04=$rett_FTE * $rett_HS;
	
	$htt_FTE= $_POST['htt_FTE'];
    $htt_HS= $_POST['htt_HS'];
	$tota05=$htt_FTE * $htt_HS;
	
	$ett_FTE= $_POST['ett_FTE'];
    $ett_HS= $_POST['ett_HS'];
	$tota06= $ett_FTE * $ett_HS;
	
	$mtt_FTE= $_POST['mtt_FTE'];
    $mtt_HS= $_POST['mtt_HS'];
	$tota07= $mtt_FTE * $mtt_HS;
	
	$totalcost= $tota01 + $tota02 + $tota03 + $tota04 + $tota05 + $tota06 + $tota07;
	$totalcostpyr= $totalcost * $activation * $ttapy;

	
	$query1="INSERT INTO teamtime (rn_ed,lab,radiology,respiratory,housesupervisor,evs,manage,totalpercase,activation,actperyear,totalcostyr) 
values ('".$tota01."','".$tota02."','".$tota03."','".$tota04."','".$tota05."','".$tota06."','".$tota07."','".$totalcost."','".$activation."','".$ttapy."','".$totalcostpyr."')";
	
	if ($db1->query($query1) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query1 . "<br>" . $db1->error;
}

	$query2="INSERT INTO vithusha (name,age) 
values ('donkey','45')";
	
	if ($db1->query($query2) === TRUE) {
    echo "New record vithusha created successfully";
} else {
    echo "Error: " . $query2 . "<br>" . $db1->error;
}
$db1->close();
	
	
    
 /*    connect to mysql database using mysqli

    //$connect = mysqli_connect($hostname, $username, $password, $databaseName);
    
    // mysql query to insert data

   // $query = "INSERT INTO `teamtime`(`tt_HS`, `tt_FTE`, `activation`) VALUES ('$tt_HS','$tt_FTE','$activation')";
    
   // $result = mysqli_query($connect,$query);
    
    // check if mysql query successful

  //  if($result)
   // {
   //     echo 'Data Inserted';
    //}
    
   // else{
   //     echo 'Data Not Inserted';
   // }
    
   // mysqli_free_result($result);
  //  mysqli_close($connect);
  */
}
?>