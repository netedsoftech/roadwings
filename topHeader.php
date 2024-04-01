<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb  mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li> -->
            
              <?php
                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                // Parse the URL
                $url_components = parse_url($actual_link);

                // Get the path from the URL
                $path = isset($url_components['path']) ? $url_components['path'] : '';

                // Split the path into segments
                $path_segments = explode('/', trim($path, '/'));

                // Generate the breadcrumb trail
                $breadcrumbs = array();
                $breadcrumb_url = '';
                foreach ($path_segments as $segment) {
                    $breadcrumb_url .= '/' . $segment;
                    // Remove the .php extension from the segment if present
                    $segment_name = pathinfo($segment, PATHINFO_FILENAME);
                    $breadcrumbs[$breadcrumb_url] = ucfirst($segment_name); // Use ucfirst to capitalize the segment
                }

                // Display the breadcrumb trail
                foreach ($breadcrumbs as $url => $name) {
                    echo '<li class="breadcrumb-item text-sm text-white active"  aria-current="page"><a href="' . $url . '" class="text-white">' . $name . '</a></li>';
                }
                ?>
            
          </ol>
         <!--  <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6> -->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
                <span class="d-sm-inline d-none text-white"><?php
                echo $_SESSION['email'];
              ?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">

              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <span  id="unreadNotificationCount" class="badge"></span>
                <i class="fa fa-bell cursor-pointer" aria-hidden="true" ></i>

              </a>
               <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
        <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                    <!-- <div class="my-auto">
                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                    </div> -->
                    <div class="d-flex flex-column justify-content-center" >
                        <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold" id="notifications"></span>
                        </h6>
                       
                    </div>
                </div>
            </a>
        </li>
      
    </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script>
        $(document).ready(function(){
            var notificationVisible = false; // Flag to track the visibility of notification div

            // Function to fetch new notifications and unread count
            function fetchNotifications() {
                $.ajax({
                    url: 'fetch_notifications.php', // PHP script to fetch notifications
                    type: 'GET',
                    success: function(response) {
                        // Update notification content
                        if (notificationVisible) {
                            $('#notifications').html(response);
                        } else {
                            var previousHeight = $('#notifications').height();
                            $('#notifications').html(response);
                            $('#notifications').height(previousHeight);
                        }

                        // Update unread count
                        var unreadCount = $('#unreadCount').val();
                        $('#unreadNotificationCount').text(unreadCount);
                    }
                });
            }

            // Call fetchNotifications initially when the page loads
            fetchNotifications();

            // Polling for new notifications every 5 seconds
            setInterval(fetchNotifications, 5000); // Adjust the interval as per your requirement

            // Toggle visibility of notification div
            $('#notifications').on('click', function() {
                notificationVisible = !notificationVisible;
            });
        });
    </script>