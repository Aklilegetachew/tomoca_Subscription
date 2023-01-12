<?php

include '../functions.php';
include '../paymproc.php';
// header('Content-Type:application/json; charset=utf-8');

//$userId = urldecode(base64_decode($_GET['UserId']));

$userId = urldecode(base64_decode($_GET['UserId']));
// geting user info 
// 919
$UserInfo = getUserInput($userId);

if ($UserInfo) : ?>

  <?php

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
  // $CartStart = intval($UserInfo['CartStart']);
  // $CartEnd = intval($UserInfo['CartEnd']);
  $ProductNum = $UserInfo['NumProducts'];
  $ShopLocation = $UserInfo['ShopLocation'];
  $ProductId = $UserInfo['userProductid'];
  // get user product selection on product id 
  // $Product_info = GetSelection($UserProductID);
  // $ProductPhoto = $Product_info['PhotoPath'];
  // $ProductDesc =  $Product_info['Description'];
  // $ProductSize =  $Product_info['size'];
  // $ProductSize =  $Product_info['Roast'];

  // shop location
  $response = GetShopLocation($ShopLocation);
  $selectedLocation = "TO.MO.CA" . " " . $response['Shopname'];
  $name = '';
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/snack.css">
    <link rel="stylesheet" href="css/three-dots.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Tomoca Coffee Shop</title>
  </head>

  <body>
    <div id="cover-spin"></div>
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
                  <textarea id="LocationComment" name="Markuparea" rows="4" cols="50" placeholder="Please enter location detail"></textarea>
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
                  <label class="labelForm" for="cars">Pickup Location:</label>
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

            // $query = "SELECT * From products WHERE id=$x";;
            // $res = mysqli_query($db, $query);
            // $res = mysqli_fetch_assoc($res);
            echo "ProductID" + $ProductId;
            $selectedItem = GetSelection(intval($ProductId));

            $Ch_title = $selectedItem['Title'];
            $Ch_quan = $selectedItem['size'];
            $Ch_prc = $selectedItem['price'];
            $Ch_amn = $selectedItem['price'];
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
          <button class="CancelBtn" id="btn-tb">Cancel Order</button>
          <button class="ConfirmBtn" type="submit" id="submit" data-order="<?php echo $UserOrderType ?>" name="submit" value="Submit">Confirm Order</button>

        </div>




        <ul class="social">
          <li>
            <a href="https://www.facebook.com/CaffeTomoca/"><img src="https://i.ibb.co/x7P24fL/facebook.png" /></a>
          </li>
          <li>
            <a href="https://twitter.com/caffeetomoca"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png" /></a>
          </li>
          <li>
            <a href="https://www.instagram.com/tomoca_coffee/?hl=en"><img src="https://i.ibb.co/ySwtH4B/instagram.png" /></a>
          </li>
        </ul>
      </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <!-- <script src="./telebirr.js"></script> -->

    <script type="text/javascript">
      const cancel = document.querySelector('#btn-tb')
      cancel.addEventListener('click', async e => {
        e.preventDefault();
        await axios.post('Cancel.php', {
          action: 'cancel',
          userId: <?php echo $userId; ?>,
          userTgId: <?php echo $UserTgId ?>,
          StartMsg: <?php echo $startMsg ?>,
          endMsg: <?php echo $CartEnd ?>
        }).then(res => {
          window.location.replace('https://t.me/TomTomChan');
        }).then(() => {
          window.href = 'https://t.me/TomTomChan'

        })
      })


      const LocationVal = document.getElementById('LocationComment')
      const SubmitPay = document.querySelector('#submit')
      const pickSubmitPay = document.querySelector('#Picksubmit')
      var userAgent = window.navigator.userAgent.toLowerCase(),
        safari = /safari/.test(userAgent),
        ios = /iphone|ipod|ipad/.test(userAgent);

      if (ios) {
        if (safari) {
          //browser
          const ReturnIOS = "Schemes"
          const BodyIOS = "t.me/TomTomChan"
        } else if (!safari) {
          //webview
          const ReturnIOS = "Schemes"
          const BodyIOS = "t.me/TomTomChan"
        };
      } else {
        //not iOS
        const ReturnIOS = "PackageName"
        const BodyIOS = "t.me/TomTomChan"
      };


      SubmitPay.addEventListener('click', async e => {
        e.preventDefault();

        const type = SubmitPay.dataset.order;

        console.log(type);
        if (type == "Delivery Order") {

          if (LocationVal.value == '') {
            console.log("null")
            alert("Dear Customer Please insert your Location Address in the space provided. ")
          } else {
            // here 
            $('#cover-spin').show(0)
            // $('body').append('<div id="cover-spin"></div>');
            await axios.post('Location.php', {
              action: 'submitlocation',
              comment: LocationVal.value,
              UID: <?php echo $userId ?>
            }).then(async res => {

              await axios.post('SUBMIT.php', {
                action: 'submit',
                Money: <?php echo $userId; ?>
              }).then(res => {
                // to here
                $("#cover-spin").hide();
                let respo = JSON.parse(res.data)
                window.location.href = respo.data.toPayUrl
              })
            })
          }
        } else {
          await axios.post('SUBMIT.php', {
            action: 'submit',
            Money: <?php echo $userId; ?>
          }).then(res => {

            let respo = JSON.parse(res.data)
            console.log(respo.data.toPayUrl)
            window.location.href = respo.data.toPayUrl
          })

        }



      })
    </script>
  </body>

  </html>

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