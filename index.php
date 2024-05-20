<?php
session_start();
include('config.php');
include("header.php");
include('function.php');
//session_destroy();
//echo "<pre>"; print_r($_SESSION);die;
  if(!($_SESSION)){
    header("location: login_page.php");
  }

  $getmonthlyearning = getmonthalyearning($mysqli);
  //echo "<pre>"; print_r($getmonthlyearning['company_earnings']);die;
  $counttotaluser = counttotaluser($mysqli);

  $countcustomers = countcustomers($mysqli);
?>


  <body>
  <title>Dashboard</title>
  <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
          <?php include("topHeader.php");?>

            <!-- top header start -->
            <div class="row">
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="main-header">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Month Earning</p>
                          <h5 class="font-weight-bolder">
                            $<?php echo $getmonthlyearning['company_earnings'] ?>
                          </h5>
                          <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                            since yesterday
                          </p> -->
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                          <img width="60" height="60" src="https://img.icons8.com/color/60/coins.png" alt="coins"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="main-header">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Users</p>
                          <h5 class="font-weight-bolder">
                            <?php echo $counttotaluser['total_users']?>
                          </h5>
                          <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+3%</span>
                            since last week
                          </p> -->
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                          <img width="60" height="60" src="https://img.icons8.com/matisse/60/gender-neutral-user--v1.png" alt="gender-neutral-user--v1"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="main-header">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Customers</p>
                          <h5 class="font-weight-bolder">
                            <?php echo $countcustomers['total_customers']?>
                          </h5>
                          <!-- <p class="mb-0">
                            <span class="text-danger text-sm font-weight-bolder">-2%</span>
                            since last quarter
                          </p> -->
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                          <img width="60" height="60" src="https://img.icons8.com/doodle/60/certificate.png" alt="certificate"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="main-header">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Current Year Sale</p>
                          <h5 class="font-weight-bolder">
                            $103,430
                          </h5>
                          <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                          </p> -->
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                          <img width="60" height="60" src="https://img.icons8.com/pulsar-line/60/fast-cart.png" alt="fast-cart"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- top header end -->

             <div class="row mt-4 ">
              <div class="col-lg-9">
                <canvas id="myChart" class="main-header"></canvas>
              </div>
              <?php include("rightbar.php");?>
             </div>
          </div>
        </div>
      </div>
    </section>


    <script>
      // Sample data for the chart
      var chartData = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
          label: 'Monthly Sales',
          data: [50, 120, 80, 200, 150],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      };
    
      // Get the canvas element
      var ctx = document.getElementById('myChart').getContext('2d');
    
      // Create the bar chart
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>



    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

