<!DOCTYPE html>
<html>
<head>
  <title>Patient query</title>
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
    <h2>View Patient Query</h2>
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
    <?php endif ;

        $username=$_GET['username'];
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'medical'); 
        $sql = "SELECT * FROM appointment WHERE (username = '$username')";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
         error_reporting(0);
                        
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $name=$row['name'];
            $email=$row['email'];
            $gender=$row['gender'];
            $date=$row['date'];
            $query=$row['query'];
            $pre=$row['prescription'];
        }
        ?>
    </div>
        <div>
        <form method="post" name="query">
        <table width='100%' border='0' cellpadding='0' cellspacing='1' class="data-table" align="center">
            <tr>
            <th scope="row">Name : </th>
            <td><?php echo $name; ?></td>
            </tr>
            <tr>
            <th scope="row">Username : </th>
            <td><?php echo $username; ?></td>
            </tr>
            <tr>
            <th>Email : </th>
            <td><?php echo $email; ?></td>
            </tr>
            <tr>
            <th>Gender : </th>
            <td><?php echo $gender; ?></td>
            </tr>
            <tr>
            <th>Date of appointment : </th>
            <td><?php echo $date; ?></td>
            </tr>
            <tr>
            <th>Query : </th>
            <td><?php echo $query; ?></td>
            </tr>
            <tr>
            <th>Prescription : </th>
            <td><textarea name="presp" style="width: 300px ; height: 200px ; margin-top: 20px ;font-size: 100%;"><?php echo $pre ;?></textarea></td>
            </tr>
        </table>
        <br>
         <input type="submit" name="submit" value="submit" class="btn">
         
         <?php
         if(isset($_POST['submit']))
            {
                $pre=$_POST['presp'];
                $db = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($db,'medical');
                
                    $sql="UPDATE `appointment` SET `prescription` = '$pre' WHERE `appointment`.`username` = '$username';";
                    $data = mysqli_query($db, $sql );
                
            }
            ?>
                <a href="index1.php"  style="background: #4067AB; color: white; border-style: none;border-radius: 20% ; padding: 7px; text-decoration:none">Back</a>
             </form>
             
</div>
</body>
</html>