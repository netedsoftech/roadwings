<?php
$id = $_SESSION['id'];
?>
<script src="addlivefeed.js"></script>
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
                
              </div>

              <div class="msgBox form-group mt-3">
                <textarea class="form-control" placeholder="Live Feed" name="" id="feedtextarea" cols="30" rows="5"></textarea>
                <button type="button" id="livefeed" class="btn form-control mt-2">Add Feed</button>
                <span id="addedbyvalue" atr="<?php echo $id?>"></span>
              </div>
              </div>