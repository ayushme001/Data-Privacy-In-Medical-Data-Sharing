<!DOCTYPE html>
<html>
<head>
  <title>send query</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

              
 <!-- for live clock -->    
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
        
<!--  till here -->


  <div class="header">
    <h2>Send Query</h2>
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

    <form method="post" name="query">
        <div class="input-group">
      <label>Name</label>
      <input type="text" name="name">
    </div>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" >
    </div>
        <div class="input-group">
      <label>Email</label>
      <input type="text" name="email" >
    </div>
    <!-- <div class="input-group">
      <label>Gender</label>
      <input type="text" name="gender" ">
    </div> -->
    <div class="input-group" >
          <select name="gender" style="margin-top: 20px; width: 265px; height: 50px; font-size: 100%;">
              <option disabled selected>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
          </select>

        <div class="input-group">
      <label>Date of Appointment</label>
      <input type="text" name="specialist" >
    </div>

    <center>
    <div class="input-group" >
          <select name="doctor" style=" margin-top: 20px; width: 265px; height: 50px; font-size: 100%;">
              <option disabled selected>Select Specialist</option>
              <option value="family">Family medicine physician</option>
              <option value="psychiatrist">Psychiatrist</option>
              <option value="dentist">dentist</option>
              <option value="neurologist">Neurologist</option>
              <option value="surgeon">Surgeon</option>
              <option value="cardiologist">Cardiologist</option>
          </select>

        </div></center>


      <textarea name="presp" placeholder="Share your problem..." style="width: 300px ; height: 200px ; margin-top: 20px ;font-size: 100%;"></textarea>
             <input type="submit" style="margin-top: 20px" name="submit" value="submit" class="btn">

    </form>   
    <?php
      // include('connection.php');
      $db = mysqli_connect('localhost', 'root', '', 'medical');
              error_reporting(0);

      
      if(isset($_POST['submit']))
      {
        $nm=$_POST['name'];
        $un=$_POST['username'];
        $em=$_POST['email'];
        $gn=$_POST['gender'];
        $sp=$_POST['specialist'];
        $doc=$_POST['doctor'];
        $pre=$_POST['presp'];
        if($nm!=""&&$un!=""&&$em!=""&&$gn!=""&&$sp!=""&&$doc!=""&&$pre!="")
        {
        $sql="INSERT INTO APPOINTMENT (`name`,`username`, `email`,`gender`,`date`, `specialist`,`query`) VALUES('$nm','$un','$em','$gn','$sp','$doc','$pre');"; 
        $data = mysqli_query($db, $sql );
        }
      }
    ?>
   <button type="button" onclick="location.href='index2.php'" class="btn" style="margin-top: 20px;" >Back</button></a>
       
   
</div>
</body>
</html>
   