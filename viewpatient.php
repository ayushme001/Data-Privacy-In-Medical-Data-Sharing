<!DOCTYPE html>
<html>
<head>
  <title>Admin login</title>
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


function passWord() {
    var testV = 1;
    var pass1 = prompt('Please Enter Your Password',' ');
    while (testV < 3) {
    if (!pass1) 
    history.go(-1);
    if (pass1.toLowerCase() == "letmein") {
    window.open('encryptdata.php');
    break;
    } 
    testV+=1;
    var pass1 = 
    prompt('Access Denied - Password Incorrect, Please Try Again.','Password');
    }
    if (pass1.toLowerCase()!="password" & testV ==3) 
    history.go(-1);
    return " ";
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
    <h2>View Patient</h2>
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
  </div>

  
    <!-- <center><input type="submit" value="View patients" style='margin-top: 40px;' class='btn2' name="patients"></input></center> -->
    
    <table width='100%' border='0' cellpadding='0' cellspacing='1' class="data-table">
        <tr>
         <th   class='data-table'> ID</th>
         <th   class='data-table'>Name </th>
         <th   class='data-table'>Username </th>
         <th  class='data-table'>Email</th>
          <th  class='data-table'>Contact</th>
          <th  class='data-table'>Address</th>
           
        </tr>
    <?php 
    
      //echo"<p style='color:red;'>qedqwdwf</p>";
      
      $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'medical'); 
      $sql = "SELECT * FROM patient_database ";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
         echo"<form method='post'  class='input-group' action='index1.php'>";
    
                 $c=1;       
              
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            //$specialist=$row['specialist'];
            echo"<tr>";
            echo"<td  height='50' name='id' class='data-table' value=''>{$row['id']}</td>" ;         
            echo "<td  height='50' name='name' class='data-table' value=''>{$row['name']}</td>" ;
            echo "<td  height='50' name='name' class='data-table' value=''>{$row['username']}</td>" ;
            echo "<td  height='50' name='name' class='data-table' value=''>{$row['email']}</td>" ;
            echo "<td  height='50' name='name' class='data-table' value=''>{$row['contact']}</td>" ;
            echo "<td  height='50' name='name' class='data-table' value=''>{$row['address']}</td>" ;
            
            echo"</tr>";
            
            }
            echo"</table>";
      

      ?>

    <br>
    <br>

  <center>
<a href="index3.php"  style="background: #4067AB; color: white; border-style: none;border-radius: 20% ; padding: 7px; text-decoration:none; margin-left: 1px">Back</a>
<button type="button" onclick="passWord()" class="btn">DECRYPT </button>
    </center>
          
   
</div>
</body>
</html>
   