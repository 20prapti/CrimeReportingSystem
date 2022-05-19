<!DOCTYPE html>
<html>
<head>
    
  <?php
    session_start();
    
    $conn=mysqli_connect("localhost","root","","crime_portal");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db("crime_portal",$conn);
    
    
    if(!isset($_SESSION['x']))
        header("location:userlogin.php");
    
    
    $u_id=$_SESSION['u_id'];
    $c_id=$_SESSION['cid'];
        
    $query="select c_id,description,inc_status,pol_status from complaint natural join user where c_id='$c_id' and u_id='$u_id'";
    $result=mysqli_query($query,$conn);
    
    $res2=mysqli_query("select d_o_u,case_update from update_case where c_id='$c_id'",$conn);
  ?>

	<title>Complaint Details</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    
   
    <body style="background-color: #dfdfdf;">
	   <nav  class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
            </div>
            
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="complainer_complain_history.php">View Complaints</a></li>
                    <li class="active" ><a href="complainer_complain_details.php">Complaints Details</a></li>
                    <li><a href="logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
         </div>
        </nav>
 
        <div style="padding:50px;margin-top:10px;">
            <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Complain Id</th>
                    <th scope="col">Description</th>
                    <th scope="col">Police Status</th>
                    <th scope="col">Case Status</th>
                </tr>
            </thead>
            <?php
              while($rows=mysqli_fetch_assoc($result)){
            ?> 
             <tbody style="background-color: white; color: black;">
              <tr>
                <td><?php echo $rows['c_id']; ?></td>
                <td><?php echo $rows['description']; ?></td>     
                <td><?php echo $rows['inc_status']; ?></td>     
                <td><?php echo $rows['pol_status']; ?></td>
              </tr>
             </tbody>
            <?php
              } 
            ?>
            </table>
        </div>
    
        <div style="padding:50px; margin-top:8px;">
            <table class="table table-bordered">
               <thead class="thead-dark" style="background-color: black; color: white;">
                   <tr>
                        <th scope="col">Date Of Update</th>
                        <th scope="col">Case Update</th>
                   </tr>
               </thead>
            <?php
                while($rows1=mysqli_fetch_assoc($res2)){
             ?> 
                <tbody style="background-color: white; color: black;">
                <tr>
                    <td><?php echo $rows1['d_o_u']; ?></td>
                    <td><?php echo $rows1['case_update']; ?></td>
                </tr>
                </tbody>
            <?php
                } 
            ?>
          
            </table>
        </div>
    
        <div style="position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          height: 30px;
          background-color: rgba(0,0,0,0.8);
          color: white;
          text-align: center;">
         <h4 style="color: white;">&copy <b>Crime Portal 2018</b></h4>
       </div> 
    
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
     <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>