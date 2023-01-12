<?php

include '../functions.php';
include '../paymproc.php';


//$userId = urldecode(base64_decode($_GET['UserId']));

$userId = urldecode(base64_decode($_GET['UserId']));
// geting user info 
$UserInfo = getUserInput($userId);

if ($UserInfo) : ?>

  <?php

  $ItemName = 1;
  $Itemnumber = 1;
  $amount = 1;
  $quantity = 1;
  // users info from DB
  $UserTgId = $UserInfo['UserId'];
  $UserPhoneNum = $UserInfo['PhoneNum'];
  //$UserProductTitle = $UserInfo['Orders'];
  $UserProductID = $UserInfo['userProductid'];
  // $UserProductQuantity = $UserInfo['quantity'];
  $UserName = $UserInfo['UserName'];
  $LastName = $UserInfo['LastName'];
  // $UserProductPrice = $UserInfo['Price'];
  $UserTotalAmount = $UserInfo['TotalAmount'];
  $UserLati = $UserInfo['lat'];
  $UserLong = $UserInfo['longtiud'];
  $UserOrderType = $UserInfo['orderType'];
  $startMsg = $UserInfo['StartID'];
  $LastMsg = $UserInfo['LastMsg'];
  $CartStart = intval($UserInfo['CartStart']);
  $CartEnd = intval($UserInfo['CartEnd']);
  $ProductNum = $UserInfo['NumProducts'];
  $ShopLocation = $UserInfo['ShopLocation'];

  // shop location
  $response = GetShopLocation($ShopLocation);
  // confirm($response);
  $selectedLocation = "TO.MO.CA" . "" . $response['Shopname'];


  // get user product selection on product id 
  $Product_info = GetSelection($UserProductID);
  $ProductPhoto = $Product_info['PhotoPath'];
  $ProductDesc =  $Product_info['Description'];
  $ProductSize =  $Product_info['size'];
  $ProductSize =  $Product_info['Roast'];

  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>Tomoca Coffee Shop</title>
  </head>

  <body>
    <div class="BigContaier">


      <header>
        <img src="./images/logo.jpg" class="avatar" alt="Tomoca logo here" />
        <h2>Tomoca Coffee Shop</h2>
      </header>

      <section class="subContainer">
        <?php if ($UserOrderType == "Delivery Order") : ?>
          <div class="Card">
            <div class="DelivHeader">
              <h3 class="cardTitle">Delivery Information</h3>
              <img src="./images/eshi-express-removebg.png" class="Imglogo" alt="eshi express logo here" />
            </div>
            <div class="CardBody">

              <div class="ListDiv">
                <div class="divForm">
                  <label class="labelForm" for="fname">First name:</label><br />
                  <input type="text" name="fname" value=<?php echo $UserName . $LastName; ?> readonly /><br />
                </div>
                <div class="divForm">
                  <label class="labelForm" for="Phname">Phone Number:</label><br />
                  <input type="text" name="Phname" value=<?php echo $UserPhoneNum; ?> readonly /><br />
                </div>
                <div class="divForm">
                  <label class="labelForm" for="Phname">Location:</label><br />
                  <div class="inputLoc">
                    <iframe src="https://www.google.com/maps/embed/v1/place?key=<?php echo $_ENV['MAPEMBADING_KEY']; ?>&q=<?php echo $UserLati; ?> , <?php echo $UserLong ?> " class="responsive-iframe" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>
                </div>
                <div class="divForm">
                  <label class="labelForm" for="Markuparea">Delivery Comment:</label><br />
                  <textarea name="Markuparea" rows="4" cols="50">Place your comment here...</textarea>
                </div>
              </div>

            </div>
          </div>
        <?php else : ?>
          <div class="Card">
            <div class="DelivHeader">
              <h3 class="cardTitle">Customer Information</h3>
            </div>
            <div class="CardBody">
              <div class="ListDiv">
                <div class="divForm">
                  <label class="labelForm" for="fname">First name:</label><br />
                  <input type="text" name="fname" value=<?php echo $UserName . $LastName; ?> readonly /><br />
                </div>
                <div class="divForm">
                  <label class="labelForm" for="Phname">Phone Number:</label><br />
                  <input type="text" name="Phname" value=<?php echo $UserPhoneNum; ?> readonly /><br />
                </div>
                <div class="divForm">
                  <label class="labelForm" for="cars">Choose Pickup Location:</label>
                 
                    <input type="text" name="shopname" value="<?php echo $selectedLocation; ?>" readonly /><br />

                 
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>



        <div class="Card">
          <h3 class="cardTitle">Order Summary</h3>
          <div class="CardBody">
            <div class="imageCon">
              <img src="./images/500g2.jpg" class="productImg" alt="image here" />
            </div>
            <?php
            for ($x = $CartStart; $x <= $CartEnd; $x++) {
              $query = "SELECT * From cart WHERE cartId=$x";;
              $res = mysqli_query($db, $query);
              $res = mysqli_fetch_assoc($res);
              $selectedItem = GetSelection($res['ProductId']);

              $Ch_title = $selectedItem['Title'];
              $Ch_quan = $res['Quantity'];
              $Ch_prc = $selectedItem['price'];
              $Ch_amn = $res['Amount'];
              $Ch_type = $selectedItem['Description'];
              $Ch_Roast = $selectedItem['Roast'];


              print_r("<div class='ProductDetail'>
                <div class='ProductTitle'>
                  
                </div>
                <div class='ProductCheck'>
                  <p>Product Type</p>
                  <p>$Ch_type</p>
                </div>
                <div class='ProductCheck'>
                  <p>Roast type</p>
                  <p> $Ch_Roast </p>
                </div>
                <div class='ProductCheck'>
                  <p>Quantity</p>
                  <p>  $Ch_quan X</p>
                </div>
                <div class='ProductCheck'>
                  <p>Price/Bag</p>
                  <p> $Ch_prc ETB</p>
                </div>
                <div class='ProductCheck'>
                  <p>Total</p>
                  <p>  $Ch_amn ETB</p>
                </div>
                
              </div>
              <hr /> ");
            }
            ?>
            <div class="subTotal">
              <div class='ProductCheck'>
                <p>Total product type</p>
                <p> <?php echo $ProductNum; ?> </p>
              </div>
              <div class='ProductCheck'>
                <p>Discount</p>
                <p> 15%</p>
              </div>
              <div class='ProductCheck'>
                <p>Total Cost</p>
                <p> <?php echo $UserTotalAmount; ?> ETB</p>
              </div>
            </div>
          </div>
        </div>


        <div class="Btns">
          <form action="https://www.sandbox.paypal.com/" method="post">
            <input type="hidden" name="cmd" value="_cart" />
            <input type="hidden" name="business" value=<?php echo $_ENV['PAYPAL_BUSSINESS_TEST']; ?> />
            <input type="hidden" name="item_name_<?php echo $ItemName; ?>" value="Coffee Bag" />
            <input type="hidden" name="item_number_<?php echo $Itemnumber; ?>" value="<?php echo $userId; ?>" />
            <input type="hidden" name="amount_<?php echo $amount; ?>" value=" <?php echo $UserTotalAmount; ?> " />
            <input type="hidden" name="quantity_<?php echo $amount; ?>" value="1" />
            <input type="hidden" name="currency_code" value="USD" />
            <input type="hidden" name="upload" value="1" />
            <!-- <input class="ConfirmBtn" type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online" /> -->
            <button class="ConfirmBtn" type="submit" id="submit" name="submit" value="Submit">Confirm Order</button>
          </form>
          <!-- <button class="ConfirmBtn" type="submit" id="submit" name="submit" value="Submit">Confirm Order</button> -->
          <button class="CancelBtn" id="btn-tb">Cancel Order</button>
        </div>
        <ul class="social">
          <li>
            <a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png" /></a>
          </li>
          <li>
            <a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png" /></a>
          </li>
          <li>
            <a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png" /></a>
          </li>
        </ul>
      </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <!-- <script src="./telebirr.js"></script> -->

    <script type="text/javascript">
    </script>
  </body>

  </html>
  <?php
  $ItemName++;
  $Itemnumber++;
  $amount++;
  $quantity++;

  ?>

<?php else : ?>

  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./style2.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  </head>

  <body>
    <div class="SmallCards">
      <div class="smallestcardsub">
        <h3>No Item Selected<h3>
            <hr />
            <p>Please go to the channel to select products</p>
            <div class="butn-go"><a href="https://t.me/TomTomChan"> <button>Back to Channel</button> </a></div>
      </div>
    </div>


  </body>

  </html>

<?php endif; ?>