<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/style.css" />

    <!-- font style start -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,300&family=Prata&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- font style end -->
  </head>
  <body>
    <section class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar start -->
    

          <?php include("navSideBar.php");?>
          <!-- Sidebar end -->
          <div class="col-lg-10 col-md-10 main-content mt-4">
             <div class="d-flex justify-content-between p-3 main-header ">
              <h5 class="text-break">Recent Shipments</h5>
              <!-- Button trigger modal -->
              <span class="rounded-pill shadow text-white"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Agent</span>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h5 class="mt-2 " id="staticBackdropLabel">Edit Agent Details</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
         <h6 class="mt-2 mb-4">Agent INFORMATION</h6>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Name <sub>*</sub></label>
              <input class="form-control" type="text" placeholder="Morissette PLC">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Username <sub>*</sub></label>
              <input class="form-control" type="text" minlength="10" maxlength="10" placeholder="wick2@roadwings">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Role</label>
              <select name="companyStatus" class="form-control">
                <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option>

              </select>
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent E-mail ID <sub>*</sub></label>
              <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
              <input class="form-control" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
            </div>
            
          </div>
          <!-- <span class="aside-hr mt-3 mb-4"></span> -->



          <div class="col-lg-4"></div>
          <div class="col-lg-4"></div>
          <div class="col-lg-4 text-end">
            <div class="form-group ">
              <button class="btn ">Submit Details</button>
            </div>
          </div>
         </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h5 class="mt-2 " id="staticBackdropLabel1">Edit Agent Details</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
         <h6 class="mt-2 mb-4">Agent INFORMATION</h6>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Name <sub>*</sub></label>
              <input class="form-control" type="text" placeholder="Morissette PLC">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Username <sub>*</sub></label>
              <input class="form-control" type="text" minlength="10" maxlength="10" placeholder="wick2@roadwings">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent Role</label>
              <select name="companyStatus" class="form-control">
                <option value="Manager">Manager</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Agent">Agent</option>

              </select>
            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Agent E-mail ID <sub>*</sub></label>
              <input class="form-control" type="email" placeholder="hudson.wilhelmine@boehm.com">
            </div>

            <div class="form-group mb-4">
              <label for="example-text-input" class="form-control-label mb-2">Contact Number <sub>*</sub></label>
              <input class="form-control" type="tel" minlength="10" maxlength="10" placeholder="+1 (323) 916-4686">
            </div>
            
          </div>
          <!-- <span class="aside-hr mt-3 mb-4"></span> -->



          <div class="col-lg-4"></div>
          <div class="col-lg-4"></div>
          <div class="col-lg-4 text-end">
            <div class="form-group ">
              <button class="btn ">Submit Details</button>
            </div>
          </div>
         </div>
        </form>
      </div>
     
    </div>
  </div>
</div>
<!-- Button trigger modal end -->
             </div>

             <div class="row mt-4 ">
              <div class="col-lg-9">
                <div class="main-header p-3 ">
                  <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Agents table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs ">Agents</th>
                              <th class="text-uppercase text-uppercase text-xxs">Role</th>
                              <th class="text-center text-uppercase text-xxs">Contact Number</th>
                              <th class="text-center text-uppercase text-xxs">Employed</th>
                              <th class="text-secondary opacity-7"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    <p class="text-xs text-secondary mb-0">username (wick2@roadwings)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Manager</p>
                                <p class="text-xs text-secondary mb-0">Organization</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                  Edit
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                    <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                    <p class="text-xs text-secondary mb-0">username (wick2@roadwings)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Programator</p>
                                <p class="text-xs text-secondary mb-0">Developer</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-secondary">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                    <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Executive</p>
                                <p class="text-xs text-secondary mb-0">Projects</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Michael Levi</h6>
                                    <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                    <p class="text-xs text-secondary mb-0">username (wick2@roadwings)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Programator</p>
                                <p class="text-xs text-secondary mb-0">Developer</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-success">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Richard Gran</h6>
                                    <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                    <p class="text-xs text-secondary mb-0">username (wick2@roadwings)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Manager</p>
                                <p class="text-xs text-secondary mb-0">Executive</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-secondary">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Miriam Eric</h6>
                                    <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                    <p class="text-xs text-secondary mb-0">username (wick2@roadwings)</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Programtor</p>
                                <p class="text-xs text-secondary mb-0">Developer</p>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-secondary">8495758496</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                              </td>
                              <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                 </div>
              </div>
              <div class="col-lg-3">
                <div class="left-content rounded">
                
                  <h4 class="text-white">Smart Shipment</h4>
                  <p class="text-white">Let plan your shipment to save cost</p>
                  <a href="#" class="btn text-white">Tell me more!</a>
              </div>

              <div class="scrollbar-main mt-3">
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
                <div class="mb-3 scrollerContent">
                  <p class="mb-0">working on that deal</p>
                  <div class="d-flex justify-content-between">
                    <small class="text-black">John son</small>
                    <small class="text-success " style="font-family: fantasy;font-size: 12px;">27/03/2024</small>
                  </div>
                </div>
              </div>

              <div class="msgBox form-group mt-3">
                <textarea class="form-control" placeholder="Live Feed" name="" id="" cols="30" rows="5"></textarea>
                <input type="submit" class="btn form-control mt-2">
              </div>
              </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
