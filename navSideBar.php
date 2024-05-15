<?php
$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', $urlArray);
  $numSegments = count($segments); 
  $currentSegment = $segments[$numSegments - 1];
  $activeclass = "";

// Define an array of page names
$pages = array("index.php", "agents.php", "company_shipment_leads.php", "add_customer.php", "billing.php");

// Check if the current segment is in the array of page names
if (in_array($currentSegment, $pages)) {
    $activeclass = "active";
}
?>
  <div class="working"></div>

<nav class="col-lg-2 col-md-2 d-none d-md-block sidebar mt-4">
            <div class="logo-img text-center mb-3 p-3">
              <img
                src="./assets/img/logo_img.png"
                alt="main_logo" class="w-100"
              />
            </div>
            <span class="aside-hr mt-3 mb-4 text-center"></span>
            <div >
              <ul class="nav flex-column">
                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'index.php' ? 'active' : ''; ?> " href="index.php">
                    <img
                      width="18"
                      height="18"
                      src="https://img.icons8.com/fluency-systems-regular/18/143e8b/pro-display-xdr.png"
                      alt="pro-display-xdr"
                      class="mx-2"
                    />
                    Dashboard
                  </a>
                </li>
                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'agents.php' ? 'active' : ''; ?> " href="agents.php">
                    <img
                      width="18"
                      height="18"
                      src="https://img.icons8.com/windows/18/143e8b/person-male.png"
                      alt="person-male"
                      class="mx-2"
                    />
                    Agents Info
                  </a>
                </li>
                <li class="nav-item mt-2 mb-2">


                  <a class="nav-link <?php echo $currentSegment == 'company_listing.php' ? 'active' : ''; ?>" href="company_listing.php">

                    <img
                      width="18"
                      height="18"
                      src="https://img.icons8.com/external-goofy-line-kerismaker/18/143e8b/external-Desk-Calender-stationery-goofy-line-kerismaker.png"
                      alt="external-Desk-Calender-stationery-goofy-line-kerismaker"
                      class="mx-2"
                    />
                    Customer Lists
                  </a>
                </li>

                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'add_customer.php' ? 'active' : ''; ?> " href="add_customer.php">
                  <img width="18" height="18" src="https://img.icons8.com/ios/18/143e8b/company--v1.png" alt="company--v1" class="mx-2"/>
                    Add Customer 
                  </a>
                </li>

             <!--    <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'add_trucker.php' ? 'active' : ''; ?>" href="add_trucker.php">
                  <img width="18" height="18" src="https://img.icons8.com/ios/18/143e8b/truck--v1.png" alt="truck--v1" class="mx-2" />
                    Add Trucker
                  </a>
                </li> -->

                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'trucker_listing.php' ? 'active' : ''; ?>" href="trucker_listing.php">
                  <img width="18" height="18" src="https://img.icons8.com/ios/18/143e8b/truck--v1.png" alt="truck--v1" class="mx-2" />
                    Trucker Listing
                  </a>
                </li>

                <?php //if($_SESSION['agentrole'] == "Admin" || $_SESSION['agentrole'] == "MANAGER" || $_SESSION['agentrole'] == "ACCOUNTS"){?>

                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'billing.php' ? 'active' : ''; ?>" href="billing.php">
                    <img width="18" height="18" src="https://img.icons8.com/fluency-systems-regular/18/143e8b/bill.png" alt="bill"  class="mx-2" />
                    Biling
                  </a>
                </li>
              <?php //} ?>

               
              </ul>

              <div >
                <ul class="nav ">
                  <!-- <li class="nav-item ">
                    <a class="nav-link " href="#">
                      <h6 class="text-xs text-black mt-4 mb-2">ACCOUNT PAGES</h6>
                    </a>
                  </li> -->
  
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                      <img
                        width="18"
                        height="18"
                        src="https://img.icons8.com/ios/18/143e8b/exit--v1.png"
                        alt="exit--v1"
                        class="mx-2"
                      />
                      Logout
                    </a>
                  </li>

                 
                  <!-- <div class="card card-plain shadow-none" id="sidenavCard">
                    <img
                      class="w-50 mx-auto"
                      src="/assets/img/icon-documentation.svg"
                      alt="sidebar_illustration"
                    />
                    <div class="card-body text-center p-3 w-100 pt-0">
                      <div class="docs-info">
                        <h6 class="mb-0">Need help?</h6>
                        <p class="text-xs font-weight-bold mb-0">
                          Please check our docs
                        </p>
                      </div>
                    </div>
                  </div> -->
                </ul>
              </div>
              </div>

          </nav>

          
 <!-- chat box start -->
 <div  class="chat-box">
	<div class="chat-box-header">
		 	<h5>Live Feed</h5>
			<p>
				<i class="fa fa-times"></i>	
			</p>
	</div>
	<div class="chat-box-body">
		<div class="chat-box-body-send">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-receive">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-receive">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-send">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-send">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-receive">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-receive">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
		<div class="chat-box-body-send">
			<p>This is my message.</p>
			<span>12:00</span>
		</div>
	</div>
	<div class="chat-box-footer">
			<button id="addExtra">
				<i class="fa fa-plus"></i>	
			</button>
			<input placeholder="Enter Your Message" type="text">
			<i class="send far fa-paper-plane"></i>
	</div>
</div>


<div class="chat-button">
	<span></span>
</div>


<div class="chatBox">
        <div class="chatBox-content">
            <span class="chatBox-close-button">&times;</span>
            <h1>Add What you want here.</h1>
        </div>
    </div>

    <style>
      .chat-box {
  height: 90%;
  width: 400px;
  position: absolute;
  margin: 0 auto;
  overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  z-index: 15;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.005);
  right: 0;
  bottom: 0;
  margin: 15px;
  background: #fff;
  border-radius: 15px;
  visibility: hidden;
}
.chat-box-header {
  height: 8%;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  display: flex;
  font-size: 14px;
  padding: 0.5em 0;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.2), 0 -1px 10px rgba(172, 54, 195, 0.3);
  box-shadow: 0 1px 10px rgba(0, 0, 0, 0.025);
}
.chat-box-header h3 {
  font-family: ubuntu;
  font-weight: 400;
  float: left;
  position: absolute;
  left: 25px;
}
.chat-box-header p {
  float: right;
  position: absolute;
  right: 16px;
  cursor: pointer;
  height: 50px;
  width: 50px;
  text-align: center;
  line-height: 3.25;
  margin: 0;
}
.chat-box-body {
  height: 75%;
  background: #f8f8f8;
  overflow-y: scroll;
  padding: 12px;
}
.chat-box-body-send {
  width: 250px;
  float: right;
  background: white;
  padding: 10px 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
  margin-bottom: 14px;
}
.chat-box-body-send p {
  margin: 0;
  color: #444;
  font-size: 14px;
  margin-bottom: 0.25rem;
}
.chat-box-body-send span {
  float: right;
  color: #777;
  font-size: 10px;
}
.chat-box-body-receive {
  width: 250px;
  float: left;
  background: white;
  padding: 10px 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
  margin-bottom: 14px;
}
.chat-box-body-receive p {
  margin: 0;
  color: #444;
  font-size: 14px;
  margin-bottom: 0.25rem;
}
.chat-box-body-receive span {
  float: right;
  color: #777;
  font-size: 10px;
}
.chat-box-body::-webkit-scrollbar {
  width: 5px;
  opacity: 0;
}
.chat-box-footer {
  position: relative;
  display: flex;
}
.chat-box-footer button {
  border: none;
  padding: 16px;
  font-size: 14px;
  background: white;
  cursor: pointer;
}
.chat-box-footer button:focus {
  outline: none;
}
.chat-box-footer input {
  padding: 10px;
  border: none;
  -webkit-appearance: none;
  border-radius: 50px;
  background: whitesmoke;
  margin: 10px;
  font-family: ubuntu;
  font-weight: 600;
  color: #444;
  width: 280px;
}
.chat-box-footer input:focus {
  outline: none;
}
.chat-box-footer .send {
  vertical-align: middle;
  align-items: center;
  justify-content: center;
  transform: translate(0px, 20px);
  cursor: pointer;
}

.chat-button {
  padding: 25px 16px;
  background: #124483;
  width: 150px;
  position: fixed;
  bottom: 0;
  right: 0;
  margin: 15px;
  border-top-left-radius: 25px;
  border-top-right-radius: 25px;
  border-bottom-left-radius: 25px;
  box-shadow: 0 2px 15px rgba(44, 80, 239, 0.21);
  cursor: pointer;
  z-index: 999;
}
.chat-button span::before {
  content: "";
  height: 15px;
  width: 15px;
  background: #47cf73;
  position: absolute;
  transform: translate(0, -7px);
  border-radius: 15px;
}
.chat-button span::after {
  content: "Message Us";
  font-size: 14px;
  color: white;
  position: absolute;
  left: 50px;
  top: 18px;
}

.chatBox {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  visibility: hidden;
  transform: scale(1.1);
  transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
}

.chatBox-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 1rem 1.5rem;
  width: 24rem;
  border-radius: 0.5rem;
}

.chatBox-close-button {
  float: right;
  width: 1.5rem;
  line-height: 1.5rem;
  text-align: center;
  cursor: pointer;
  border-radius: 0.25rem;
  background-color: lightgray;
}

.close-button:hover {
  background-color: darkgray;
}

.show-chatBox {
  opacity: 1;
  visibility: visible;
  transform: scale(1);
  transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
  z-index: 30;
}

@media screen only and (max-width: 450px) {
  .chat-box {
    min-width: 100% !important;
  }
}
    </style>

    <script>
      $('.chat-button').on('click' , function(){
	$('.chat-button').css({"display": "none"});
	
	$('.chat-box').css({"visibility": "visible"});
});

$('.chat-box .chat-box-header p').on('click' , function(){
	$('.chat-button').css({"display": "block"});
	$('.chat-box').css({"visibility": "hidden"});
})

$("#addExtra").on("click" , function(){
		
		$(".chatBox").toggleClass("show-chatBox");
})

$(".chatBox-close-button").on("click" , function(){
	$(".chatBox").toggleClass("show-chatBox");
})
    </script>
 <!-- chat box end -->
 