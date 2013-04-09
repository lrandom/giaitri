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
 <div class="container-fluid wrapper">
    <h4>Thay đổi quyền truy cập</h4>
    <div class="navbar">
        <div class="navbar-inner">

            <div class="btn-group">
                <a href="<?php echo $add_link; ?>" class="btn">Thêm quyền</a>
            </div>
            <div class="btn-group">
                <div class="input-append">
                    <select class="btn option-search">
                        <option value="id">ID</option>
                        <option value="func_name">Tên vai trò</option>
                    </select>
                    <input class="span2 input-medium search-query" id="appendedInputButton" type="text">
                    <script type="text/javascript">
                    $('.search-query').keypress(function (e) {
                        var code = (e.keyCode ? e.keyCode : e.which);
                        if (code == 13) {
                            var key_q = $('.option-search option:selected').val();
                            var q = $('.search-query').val();
                            if (key_q != "" && q != "") {
                                location.href = "<?php echo $search_link ?>" + key_q + "&q=" + q;
                            }
                        }
                    })
                    </script>
                </div>
            </div>
            <div class="btn-group">
                <a href="<?php echo $all_link; ?>" class='btn'>Tất cả</a>
            </div>
        </div>
    </div>
    <!--show alert messager-->
    <?php
    if(isset($alert_state)){
       ?>
       <div class='alert alert-<?php echo $alert_state; ?>'>
        <button type="button" class="close" data-dismiss="alert">
         &times;
     </button>
     <?php echo $alert_msg; ?>
 </div>
 <?php
}
?>
<!--end show alert messager-->
<div class="row-fluid wrapper">
    <div class="span12 ">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <a href="">
                            No ID</a>
                        </th>
                        <th>
                            <a href="">
                                Quyền hạn truy cập
                            </a>
                        </th>
                        <th>
                            Cho phép
                        </th>
                        <th>
                            <a href="">
                                Cập nhật lần cuối
                            </a>
                        </th>
                        <th>
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($perm_list as $r) {
                        ?>
                        <tr>
                            <td><?php echo $r->id ?>
                            </td>
                            <td><?php echo $r->desc ?>
                            </td>
                            <td>
                                <?php 
                                $r->perm=str_replace(CRUD_CREATE,'<a href="javascript:;">'.CRUD_CREATE_LABEL.'</a>-', $r->perm);

                                $r->perm=str_replace(CRUD_READ,'<a href="javascript:;">'.CRUD_READ_LABEL.'</a>-', $r->perm);

                                $r->perm=str_replace(CRUD_UPDATE,'<a href="javascript:;">'.CRUD_UPDATE_LABEL.'</a>-', $r->perm);

                                $r->perm=str_replace(CRUD_DELETE,'<a href="javascript:;">' .CRUD_DELETE_LABEL.'</a>-', $r->perm);
                                $r->perm=rtrim($r->perm,'-');
                                echo $r->perm;
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo $r->last_update;
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-info"  href="<?php echo $edit_link.$r->id.'/'.$role_id ?>">
                                    <?php echo EDIT_LABEL ?></a>
                                </td>
                                <td>

                                    <a class="btn btn-danger" href="<?php echo $delete_link.$r->id; ?>" onclick='return confirm("Bạn thực sự muốn xóa?")'>
                                        <?php echo DELETE_LABEL ?></a>

                                    </td>
                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (isset($page_link)) {
                      echo $page_link;
                  }
                  ?>
              </div>
          </div>
          <!--end row fluid-->
          <?php
          $CI -> load -> view('back_end/includes/footer');
          ?>
      </div>
      <!--/.fluid-container-->
  </body>
  </html>
