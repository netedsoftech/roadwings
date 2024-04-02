<?php

$countPending = pedingCount($mysqli);
$countWorking = workingCount($mysqli);
$countApproved = approvedCount($mysqli);
$countRejected = rejectedCount($mysqli);

?>

<div class="col-lg-3">
                  <div class="main-header ">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Companies Status</h6>
                  </div>
                  <div class="card-body p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/color/35/hourglass-sand-top.png" alt="hourglass-sand-top">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Pending</h6>
                            <!-- <span class="text-xs"><?php echo $countPending;?> in stock, <span class="font-weight-bold">346+ sold</span></span> -->
                            <span class="text-xs"><?php echo $countPending;?> is Pending <span class="font-weight-bold"></span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/fluency/35/hard-working.png" alt="hard-working">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Working</h6>
                            <span class="text-xs"><?php echo $countWorking?> <span class="font-weight-bold"> is Working</span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/doodle/35/ok.png" alt="ok">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Approved</h6>
                            <span class="text-xs"><?php echo $countApproved?> is active <span class="font-weight-bold"></span></span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark  text-center">
                            <img width="35" height="35" src="https://img.icons8.com/external-bearicons-flat-bearicons/35/external-rejected-approved-and-rejected-bearicons-flat-bearicons-3.png" alt="external-rejected-approved-and-rejected-bearicons-flat-bearicons-3">
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Rejected</h6>
                            <span class="text-xs font-weight-bold"><?php echo $countRejected?> is Rejected</span>
                          </div>
                        </div>
                        <div class="d-flex">
                          <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>