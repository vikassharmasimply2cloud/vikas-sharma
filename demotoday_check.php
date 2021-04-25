<!DOCTYPE html>
<?php
if(isset($_POST['fromdate']))
$fromdate=$_POST['fromdate'];
if(isset($_POST['todate']))
$todate=$_POST['todate'];

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
</head>
<body>
<?php include('tabs.php'); ?>
<?php include('subtab.php');

?>

<div class="tab">
<?php
if(isset($_POST['fromdate']))
{
//if($fromdate){?>
<button class="tablinks" onclick="openCity(event, 'Today')" >Today</button>
  <button class="tablinks" onclick="openCity(event, 'This Month')">This Month</button>
    <button class="tablinks" onclick="openCity(event, 'Specific Date' )" id="defaultOpen">Specific Date</button>
  <button class="tablinks" onclick="openCity(event, 'All')">All</button>
<?php
}
else
{
	?>
<button class="tablinks" onclick="openCity(event, 'Today')" id="defaultOpen">Today</button>
  <button class="tablinks" onclick="openCity(event, 'This Month')">This Month</button>
    <button class="tablinks" onclick="openCity(event, 'Specific Date')">Specific Date</button>
  <button class="tablinks" onclick="openCity(event, 'All')">All</button>
<?php
}

	?>
</div>
<?php
$connectionselect = mysqli_connect("localhost","placementcrm","Paul123456!") or die("Server can't be contacted");
$dbselect= mysqli_select_db($connectionselect,"placementcrm") or die("Coud,nt Select Database");
?>
<div id="Today" class="tabcontent">
 <?php $field="FollowupDate"; 
 $an=0;
$date=date_default_timezone_set('Asia/Kolkata');
                        $today=date('Y-m-d H:i');
						$dt=substr($today,0,10);
         $rec_limit = 100;
		 		 echo"<font face='Verdana' size='3' color='#006666'><b>Call type :</font><font face='Verdana' size='2' color='brown'> Demo Scheduled &nbsp;&nbsp;&nbsp;&nbsp; </font> </b> <br>";
 $sql = "SELECT * FROM  StudentFollow where  DemoDate='$dt' and Comments!='Lead' order by DemoTime desc";
        $retval = mysqli_query( $connectionselect,$sql  ); 
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         
		 }
		   $num_rows = mysqli_num_rows($retval);
		  if($num_rows)
	{
   echo" <table class='table table-hover'><tr><th scope='col'>S.No.</th><th scope='col'>Name</th><th scope='col'>Lead Source</th><th scope='col'>Lead Status</th><th scope='col'>Demo Date & Time</th><th scope='col'>Converted</th><th scope='col'>Remarks</th></tr>";

         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
			 $sqlq = "SELECT * ". 
            "FROM students where ID='{$row['SID']}' ";          
         $q = mysqli_query( $connectionselect,$sqlq  );
		 $roww = mysqli_fetch_array($q);
             $phone=$roww['Phone'];
			              $checkid=$row['SID'];
               $lt= $roww['LeadType'];
$dn=$row['DemoDate']." ".$row['DemoTime'];
				 $sec = strtotime($dn); 
				 $nn = date("d-M-Y h:i A", $sec); 
					 if($roww['LeadStatus']=='converted')
	$dr1="Yes";
else
	$dr1="No";
		 	 $an++;
			 echo "<tr class='table-row'data-href='student_details.php?pid=$checkid'><td> ".
               "$an</td><td>".
				 "{$roww['Name']}</a></td><td>".
				"  {$roww['LeadSource']} </td><td>".
	     		"  {$roww['LeadStatus']} </td><td>".
					" $nn </td><td>".
	     		"  $dr1 </td><td>".
"  {$row['Comments']} </td></tr>";
         }
		 echo"</table>";
	}
		 else
		
	{
		echo"<font face='Verdana' size='3' color='Red'><b><center><b>No Demo Scheduled for Today</b></font>";
	}

?>
</div>

<div id="This Month" class="tabcontent">
   <?php 	$field="FollowupDate"; 
   $bnn=0;
$date=date_default_timezone_set('Asia/Kolkata');
                        $today=date('Y-m-d H:i');
						$dt=substr($today,0,10);
$month=date('m');
$year=date('Y');
$fdate=$year."-".$month."-01";
$edate=$year."-".$month."-31";


         $rec_limit = 100;
		 		 echo"<font face='Verdana' size='3' color='#006666'><b>Call type :</font><font face='Verdana' size='2' color='brown'> Demo Scheduled &nbsp;&nbsp;&nbsp;&nbsp; </b></font><br>";

 $sql = "SELECT * FROM  StudentFollow where DemoDate>='$fdate' and DemoDate<='$edate'  order by DemoDate desc,DemoTime desc";
			
echo"$fdate  to  $edate";
			 
         $retval = mysqli_query( $connectionselect,$sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         
		 }
		   $num_rows = mysqli_num_rows($retval);
		  if($num_rows)
	{
		 
   echo" <table class='table table-hover'><tr><th scope='col'>S.No.</th><th scope='col'>Name</th><th scope='col'>Lead Source</th><th scope='col'>Lead Status</th><th scope='col'>Demo Date & Time</th><th scope='col'>Enrolled</th><th scope='col'>Remarks</th></tr>";

         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


			 $sqlq = "SELECT * ". 
            "FROM students where ID='{$row['SID']}' ";
            
         $q = mysqli_query( $connectionselect,$sqlq);

		 $roww = mysqli_fetch_array($q);
             $phone=$roww['Phone'];
			              $checkid=$row['SID'];
               $lt= $roww['LeadType'];
		 	 
				 $bnn++;
				 $dn=$row['DemoDate']." ".$row['DemoTime'];
				 $sec = strtotime($dn); 
				 $nn = date("d-M-Y h:i A", $sec); 
				
	 	 if($roww['LeadStatus']=='converted')
	$dr1="Yes";
else
	$dr1="No";
				 echo "<tr class='table-row'data-href='student_details.php?pid=$checkid'><td> ".
               "$bnn</td><td>".
				 "{$roww['Name']}</td><td>".
				"  {$roww['LeadSource']} </td><td>".
	     		"  {$roww['LeadStatus']} </td><td>".
 	     			" $nn </td><td>".
	     		"  $dr1 </td><td>".
"  {$row['Comments']} </td></tr>";
			 
         }
		 echo"</table>";
	}
		 else
		
	{
		echo"<font face='Verdana' size='3' color='Red'><b><center><b>No Demo Scheduled in this month</b></font>";
	}

?>
</div>
<div id="Specific Date" class="tabcontent">
<form name=myform method="post" action="demotoday_check.php">
<font face="Verdana" size="1" color="#006666"><b>Start: &nbsp;</td><td><font face="arial" size="2" color="black"><INPUT type='date' name='fromdate' value='yyyy-mm-dd'></td><td><font face="Verdana" size="1" color="#006666"><b>End: &nbsp;</td><td><font face="arial" size="2" color="black"><INPUT type='date' name='todate' value='yyyy-mm-dd'></b></b></font></font></td><td><input type="button" style="font-face: 'Comic Sans MS'; font-size: larger; color: white; background-color: green; border: 3pt ridge lightgrey" value=" Submit " onclick=check()></td>
<?php				
if(isset($_POST['fromdate'])){		 
							$field="FollowupDate"; 
							$cnn=0;
$date=date_default_timezone_set('Asia/Kolkata');
                        $today=date('Y-m-d H:i');
						$dt=substr($today,0,10);
         $rec_limit = 100;
		 		 echo"<font face='Verdana' size='3' color='#006666'><b><br>Call type :</font><font face='Verdana' size='2' color='brown'> Demo Scheduled &nbsp;&nbsp;&nbsp;&nbsp; </b></font><br>";

 $sql = "SELECT * FROM  StudentFollow where DemoDate>='$fromdate' and DemoDate<='$todate'  order by DemoDate desc,DemoTime desc";
			
echo"$fromdate  to  $todate";
			 
         $retval = mysqli_query($connectionselect,$sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         
		 }
		   $num_rows = mysqli_num_rows($retval);
		  if($num_rows)
	{
		 
   echo" <table class='table table-hover'><tr><th scope='col'>S.No.</th><th scope='col'>Name</th><th scope='col'>Lead Source</th><th scope='col'>Lead Status</th><th scope='col'>Demo Date & Time</th><th scope='col'>Enrolled</th><th scope='col'>Remarks</th></tr>";

         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


			 $sqlq = "SELECT * ". 
            "FROM students where ID='{$row['SID']}' ";
            
         $q = mysqli_query( $connectionselect,$sqlq  );

		 $roww = mysqli_fetch_array($q);
             $phone=$roww['Phone'];
			              $checkid=$row['SID'];
               $lt= $roww['LeadType'];
		 	 $dn=$row['DemoDate']." ".$row['DemoTime'];
				 $sec = strtotime($dn); 
				 $nn = date("d-M-Y h:i A", $sec); 
				 	 if($roww['LeadStatus']=='converted')
	$dr1="Yes";
else
	$dr1="No";
				 $cnn++;
				 echo "<tr class='table-row'data-href='student_details.php?pid=$checkid'><td> ".
               "$cnn</td><td>".
				 "{$roww['Name']}</td><td>".
				"  {$roww['LeadSource']} </td><td>".
	     		"  {$roww['LeadStatus']} </td><td>".
 	     			" $nn </td><td>".
	     		"  $dr1 </td><td>".
"  {$row['Comments']} </td></tr>";
			 
			 
         }
		 echo"</table>";
	}
		 else
		
	{
		echo"<font face='Verdana' size='3' color='Red'><b><center><b>No Demo Scheduled in specified period</b>";
	}


 }
 ?>
 </form>
</div>
<div id="All" class="tabcontent">
<?php $field="FollowupDate"; 
$dnn=0;

$date=date_default_timezone_set('Asia/Kolkata');
                        $today=date('Y-m-d H:i');
						$dt=substr($today,0,10);
         $rec_limit = 100;
		 		 echo"<font face='Verdana' size='3' color='#006666'><b>Call type :</font><font face='Verdana' size='2' color='brown'>Demo Scheduled &nbsp;&nbsp;&nbsp;&nbsp;</b></font> <br>";

 $sql = "SELECT * FROM  StudentFollow where DemoDate!='0000-00-00'order by DemoDate desc,DemoTime desc";
			

			 
         $retval = mysqli_query($connectionselect,$sql);
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         
		 }
		   $num_rows = mysqli_num_rows($retval);
		  if($num_rows)
	{
		 
   echo" <table class='table table-hover'><tr><th scope='col'>S.No.</th><th scope='col'>Name</th><th scope='col'>Lead Source</th><th scope='col'>Lead Status</th><th scope='col'>Demo Date & Time</th><th scope='col'>Enrolled</th><th scope='col'>Remarks</th></tr>";

         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


			 $sqlq = "SELECT * ". 
            "FROM students where ID='{$row['SID']}' ";
            
         $q = mysqli_query($connectionselect, $sqlq);

		 $roww = mysqli_fetch_array($q);
             $phone=$roww['Phone'];
			              $checkid=$row['SID'];
               $lt= $roww['LeadType'];
		 	 $dn=$row['DemoDate']." ".$row['DemoTime'];
				 $sec = strtotime($dn); 
				 $nn = date("d-M-Y h:i A", $sec); 
				 					 if($roww['LeadStatus']=='converted')
	$dr1="Yes";
else
	$dr1="No";
				 $dnn++;
				 echo "<tr class='table-row'data-href='student_details.php?pid=$checkid'><td> ".
               "$dnn</td><td>".
				 "{$roww['Name']}</td><td>".
				"  {$roww['LeadSource']} </td><td>".
	     		"  {$roww['LeadStatus']} </td><td>".
 	     			" $nn </td><td>".
	     		"  $dr1 </td><td>".
"  {$row['Comments']} </td></tr>";
			 
			 
         }
		 echo"</table>";
	}
		 else
		
	{
		echo"<font face='Verdana' size='3' color='Red'><b><center><b>No Demo Scheduled in this month</b>";
	}
	?>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

function check()
{

document.myform.submit();


}
</script>
   
</body>
</html> 
