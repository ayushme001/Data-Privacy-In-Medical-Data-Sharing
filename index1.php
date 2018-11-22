<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.html");
  }
  
  //ALTER TABLE yourtable ADD q6 VARCHAR( 255 ) after q5
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    
     
<script type="text/javascript"> 
    var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
    var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"
    function getthedate()
    {
        var mydate=new Date()
        var year=mydate.getYear()
        if (year < 1000)
            year+=1900
        var day=mydate.getDay()
        var month=mydate.getMonth()
        var daym=mydate.getDate()
        if (daym<10)
            daym="0"+daym
        var hours=mydate.getHours()
        var minutes=mydate.getMinutes()
        var seconds=mydate.getSeconds()
        var dn="AM"
        if (hours>=12)
            dn="PM"
        if (hours>12)
        {
            hours=hours-12
        }
        if (hours==0)
        hours=12
        if (minutes<=9)
            minutes="0"+minutes
        if (seconds<=9)
            seconds="0"+seconds

        var cdate="<small><font class='link'><b>"+dayarray[day]+", "+montharray[month]+" "+daym+", "+year+" "+hours+":"+minutes+":"+seconds+" "+dn
                    +"</b></font></small>"

        if (document.all)
            document.all.clock.innerHTML=cdate
        else if (document.getElementById)
            document.getElementById("clock").innerHTML=cdate
        else
            document.write(cdate)
    }
    if (!document.all&&!document.getElementById)
    getthedate()
    function goforit()
    {
        if (document.all||document.getElementById)
        setInterval("getthedate()",1000)
    }
    
   function valthisform(){
 var chkd = document.attn.present.checked || document.attn.absent.checked

 if (chkd == true){

 } else {
    alert ("please check a checkbox")
 }

}

</script>
   
    
  
<span id="clock"  >
 <small>
     <font class='link' >  
       <script> goforit();</script>
     </font>
 </small>
</span>
        
    
    
<div class="header">
	<h2>Doctor's home</h2>
</div>


    
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) :
        $username=$_SESSION['username']; ?>
    	<p>Welcome <strong><?php echo "$username"; ?></strong></p>
    
        <p style='margin-top: 20px ' align="right"> <a href="index2.php?logout='1'" style="color: red;">logout</a> </p>

    <?php endif ?>
    <?php
        
        $date = date('d/m/Y');
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'medical'); 
        $sql = "SELECT specialist FROM doctor_database WHERE (username = '$username')";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
         
                        
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $specialist=$row['specialist'];
        echo "specialist : {$row['specialist']}  <br> " ;
        // //SELECT id FROM cc ORDER BY id DESC LIMIT 1
        // $sql1 = "SELECT id FROM student_database ORDER BY id DESC LIMIT 1";
        // $retval1 = mysqli_query($db , $sql1 );
        // $getid = mysqli_fetch_assoc($retval1);
        // //$getid=$result['id'];
   }
    ?>
      <br/>
      <center>
    <a href="viewpatient1.php?specialist=<?php echo $specialist;?>"><button  style='margin-top: 30px ' class='btn2' name='patient'">View patients</button></a>
  </center>
<form method='post'  class='input-group' action='index1.php'>


       
</div>		
</body>
</html>