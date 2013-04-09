<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<?php
$CI -> load -> view('back_end/includes/header.php');
?>

<body>
  <?php
  $CI -> load -> view('back_end/includes/nav_menu');
  ?>
  <script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
  })
  </script>

  <div class="container-fluid wrapper">
   <!--show alert messager-->
   <?php 
   if(isset($alert_state)){
    ?>
    <div class='alert alert-<?php echo $alert_state; ?>'>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $alert_msg; ?>
    </div>
    <?php
  }
  ?>

  <!--end show alert messager-->
  <fieldset>
    <legend>
      <?php echo $title ?>
    </legend>

    <form class="form-horizontal" id="form-add-role" method="post">
      <div class="control-group">
        <label class="control-label" for="crud">Cho phép</label>
        <div class="controls">
          <div id="cat-wrap" style="height: 150px; width: 300px ;overflow-y:scroll; background: #FFFFFF; border: 1px solid #CCCCCC; padding: 5px">
            <div>
              <input type="checkbox" name="crud[]" value="<?php echo CRUD_CREATE; ?>"
              <?php
              if(preg_match('/'.CRUD_CREATE.'/', $crud_list[0]->perm)){
                echo 'checked="checked"';
              }
              ?>
              style="float:left"/>
              <span style="margin-left:5px;"><?php echo CRUD_CREATE_LABEL; ?></span>
            </div>
            <div>
              <input type="checkbox" name="crud[]" value="<?php echo CRUD_READ; ?>" 
              <?php
              if(preg_match('/'.CRUD_READ.'/', $crud_list[0]->perm)){
                echo 'checked="checked"';
              }
              ?>
              style="float:left"/>
              <span style="margin-left:5px;"><?php echo CRUD_READ_LABEL; ?></span>
            </div>
            <div>
              <input type="checkbox" name="crud[]" value="<?php echo CRUD_UPDATE; ?>"
              <?php
              if(preg_match('/'.CRUD_UPDATE.'/', $crud_list[0]->perm)){
                echo 'checked="checked"';
              }
              ?>
              style="float:left"/>
              <span style="margin-left:5px;"><?php echo CRUD_UPDATE_LABEL; ?></span>
            </div>
            <div>
              <input type="checkbox" name="crud[]" value="<?php echo CRUD_DELETE; ?>"
              <?php
              if(preg_match('/'.CRUD_DELETE.'/', $crud_list[0]->perm)){
                echo 'checked="checked"';
              }
              ?>
              style="float:left"/>
              <span style="margin-left:5px;"><?php echo CRUD_DELETE_LABEL; ?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">
            <?php echo EDIT_LABEL; ?>
          </button>
          <a href="<?php echo $back_link ?>" class="btn">
            Quay lại
          </a>
        </div>
      </div>
    </form>
  </fieldset>

  <hr>
  <?php
  $CI = &get_instance();
  $CI -> load -> view('back_end/includes/footer');
  ?>
</div>
<!--end row fluid-->


</div><!--/.fluid-container-->
</body>
</html>