<!DOCTYPE html>
<html>
    <head>
        <title>Lab 10</title>
        <style>
            #car{
                margin-right:70px;
                text-align: center;
                width: 100px;
                height: 30px;
                background-color:black ;
                color: white;
            }
            #signout{
                margin-right:70px;
                text-align: center;
                width: 100px;
                height: 30px;
                background-color:black ;
                color: white;
            }
            .butt{
                margin-left: 40px;
            }
            img{
                background-position: center; 
            height: 100vh; 
            margin: 0; 
            /* display: flex; */
            justify-content: center;
            align-items: center;
            }
            #car:hover {
            color: yellow;
        }
        </style>
    </head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit(); }
?>
<h1 style="text-align: center;">Welcome To Cars Project Done By Fatma
</h1>
<div class="butt">
<!-- <a style="font-size: 18px; margin-left: 10px; margin-top: 7px; color: white; padding-top: 19px;">Back</a> -->
       
  <a href="selectAddress.php"><button id="car" >address</button>   </a>
  <a href="selectCar.php"><button id="car">car</button>  </a>
  <a href="selectCar_part.php"><button id="car">car_part</button>  </a>
  <a href="selectCustomer.php"><button id="car">customer</button>  </a>
  <a href="selectDevice.php"><button id="car">device</button>  </a>
  <a href="selectManufacture.php"><button id="car">manufacture</button>  </a>
  <a href="selectOrders.php"><button id="car">orders</button>  </a>
  <a href="signout.php"><button id="signout">sign out</button>  </a>

<br>

</div>
<br>

<img style="width: 100%;" src="img.jpg" alt="car img" >


</body>
</html>

