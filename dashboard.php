<?php  
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href=" assest/bootstrap/bootstrap.min.css">
    <style>
        .container{
            background-color: rgb(32, 113, 153);
           
            height: 300px;
            width: 900px;
            font-family: georgia;
            text-align: center;
            border-radius: 50px;
            box-shadow: 0px 4px 20px blue;
        }
    </style>
</head>
<body>
    <?php include 'components/NavBar.php'; ?>

     <div class="container mt-5 ">
        <h1 class="py-4">Your Dashboard</h1> 
       <div>
        <?php echo '<h1>Welcome, ' .$_SESSION['first_name']. ' ' .$_SESSION['last_name']. '! <?h1>'; ?>
        <?php echo '<br>';  ?>
        <?php echo'<h4>Email: '  .$_SESSION['email']. '</h4>';  ?>
        <?php echo '<h4>Phone Number: '  .$_SESSION['phone']. '</h4>';  ?>
       </div>
       <div >
        <p class="text-black">Go
       <a href="register.php" class="btn btn-info text-black">Back</a>
        to registration page</p>
       </div>
     </div>

     <script src="assest/bootstrap/bootstrap.bundle.js"></script>
</body>
</html>