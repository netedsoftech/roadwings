<?php
$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $segments = explode('/', $urlArray);
  $numSegments = count($segments); 
  $currentSegment = $segments[$numSegments - 1];
  $activeclass = "";

// Define an array of page names
$pages = array("index.php", "agents.php", "shipment_leads.php", "add_company.php", "billing.php");

// Check if the current segment is in the array of page names
if (in_array($currentSegment, $pages)) {
    $activeclass = "active";
}
?>
<nav class="col-lg-2 col-md-2 d-none d-md-block sidebar mt-4">
            <div class="logo-img text-center mb-3 p-3">
              <img
                src="/assets/img/logo_img.png"
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
                  <a class="nav-link <?php echo $currentSegment == 'shipment_leads.php' ? 'active' : ''; ?> " href="shipment_leads.php">
                    <img
                      width="18"
                      height="18"
                      src="https://img.icons8.com/external-goofy-line-kerismaker/18/143e8b/external-Desk-Calender-stationery-goofy-line-kerismaker.png"
                      alt="external-Desk-Calender-stationery-goofy-line-kerismaker"
                      class="mx-2"
                    />
                    Com Listing
                  </a>
                </li>

                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'add_company.php' ? 'active' : ''; ?> " href="add_company.php">
                    <img
                      width="18"
                      height="18"
                      src="https://img.icons8.com/external-goofy-line-kerismaker/18/143e8b/external-Desk-Calender-stationery-goofy-line-kerismaker.png"
                      alt="external-Desk-Calender-stationery-goofy-line-kerismaker"
                      class="mx-2"
                    />
                    Add Compnay 
                  </a>
                </li>

                <li class="nav-item mt-2 mb-2">
                  <a class="nav-link <?php echo $currentSegment == 'billing.php' ? 'active' : ''; ?>" href="billing.php">
                    <img width="18" height="18" src="https://img.icons8.com/fluency-systems-regular/18/143e8b/bill.png" alt="bill"  class="mx-2" />
                    Biling
                  </a>
                </li>
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