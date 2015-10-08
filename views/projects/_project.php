<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <?php 
            if(isset($var['image_link'])){
                echo "<img src='{$var['image_link']}' alt=''>";
            }else{
                echo "<img src='http://placehold.it/320x150' alt=''>";
            }
        ?>
        <div class="caption">
            <h4 class="pull-right">$<?php echo $var['price'] ?></h4>
            <h4><a href="#"  data-toggle="modal" data-target="#project-<?php echo $var['id'];?>" ><?php echo substr($var['name'],0,12)."..."; ?></a>
            </h4>
            <p><?php echo substr($var['description'],0,63)."..."; ?></p>
        </div>
        <div class="ratings">
            <p class="pull-right"><?php echo $var['count']; ?> Availabe</p>
            <p>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
            </p>
        </div>
    </div>
</div>
<div id="project-<?php echo $var['id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center"><?php echo $var['name']; ?></h1>
          </div>
          <div class="modal-body">
            <span class="pull-right"><a href="#">$ <?php echo $var['price']; ?></a></span>
            <span><a href="#"><?php echo $var['count']; ?> Available</a></span>
            <h3 class="form col-md-12 center-block text-decore">
                <?php echo $var['description']; ?>
            </h3>
            <form  method="post" remote= true id = "<?php echo $var['id'];?>" class="cart">
              <input type="hidden" name="project_id" value="<?php echo $var['id']; ?>">
              <input type="submit" name = "submit" class="btn btn-primary btn-lg btn-block" value="Add To Cart">
            </form>
            
                
          </div>
          <div class="modal-footer">
              <div class="col-md-12">
              <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button> -->
              </div>    
          </div>
      </div>
  </div>
</div>
