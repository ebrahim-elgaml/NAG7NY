<div id="cart-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center">Added Items</h1>
          </div>
          <div class="modal-body">
            <ul class="list-group">
                <?php
                    $result = get_elements_in_cart();
                    $numRows = $result->num_rows;
                    if ($numRows > 0) {
                        while ($cart = $result->fetch_assoc()) {
                            include '_cart.php';
                        }
                    }else{
                        echo '<h3 class="form col-md-12 center-block text-decore" id="no-elements"> No elements in cart</h3>';
                    }
                ?>
            </ul>
          </div>
          <div class="modal-footer">
              <div class="col-md-12">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>    
          </div>
      </div>
  </div>
</div>