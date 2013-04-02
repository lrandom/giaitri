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
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Show<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="@(this.Url.Action("role"))?get_type=Actived">Actived Role</a> </li>
                        <li><a href="@(this.Url.Action("role"))?get_type=Disabled">Disabled Role</a> </li>
                        <li><a href="@(this.Url.Action("role"))">All</a> </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <a href="@(Constants.BASE_URL + "role/add")" class="btn">Add </a>
                </div>
                <div class="btn-group">
                    <div class="input-append">
                        <select class="btn option-search">
                            <option value="NoId">NoID</option>
                            <option value="RoleName">Role Name</option>
                        </select>
                        <input class="span2 input-medium search-query" id="appendedInputButton" type="text">
                        <script type="text/javascript">
                            $('.search-query').keypress(function (e) {
                                var code = (e.keyCode ? e.keyCode : e.which);
                                if (code == 13) {
                                    var key_q = $('.option-search option:selected').val();
                                    var q = $('.search-query').val();
                                    if (key_q != "" && q != "") {
                                        location.href = "@(Constants.BASE_URL)admin/category?key_q=" + key_q + "&q=" + q;
                                    }
                                }
                            })
                        </script>
                    </div>
                </div>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Show in<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="@(this.Url.Action("role", new RouteValueDictionary((PagerRouter)ViewBag.pagerRouter)))&page_size=5">
                            5 records/page</a> </li>
                        <li><a href="@(this.Url.Action("role", new RouteValueDictionary((PagerRouter)ViewBag.pagerRouter)))&page_size=10">
                            10 records/page</a> </li>
                        <li><a href="@(this.Url.Action("role", new RouteValueDictionary((PagerRouter)ViewBag.pagerRouter)))&page_size=15">
                            15 records/page</a> </li>
                        <li><a href="@(this.Url.Action("role", new RouteValueDictionary((PagerRouter)ViewBag.pagerRouter)))&page_size=20">
                            20 records/page</a> </li>
                    </ul>
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
                                <a href="@(this.Url.Action("role", (RoutingValues)) + "&order_by=noID&order_type=" + ViewBag.pagerRouter.order_type_next)">
                                    No ID</a>
                            </th>
                            <th>
                                Role name
                            </th>
                            <th>
                                State
                            </th>
                            <th>
                                <a href="@(this.Url.Action("role", (RoutingValues)) + "&order_by=last_update&order_type=" + ViewBag.pagerRouter.order_type_next)">
                                    Last_update</a>
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                                <td>@role.id
                                </td>
                                <td>@role.name
                                </td>
                                <td>
                   
                                </td>
                                <td>@role.last_update
                                </td>
                                <td>
                                    <a class="btn btn-info"  href="@(Constants.BASE_URL + "admin/role?action=edit&id=" + @role.id)">
                                        Edit</a>
                                </td>
                                <td>
                                 
                                        <a class="btn btn-danger" href="@(Constants.BASE_URL + "admin/role?action=delete&id=" + @role.id)">
                                            Delete</a>
                                    
                                </td>
                                <td>
                               
                                    <a class="btn btn btn-info" href="@(Constants.BASE_URL + "role/change_perm?id=" + @role.id)">
                                        Change permision</a> 
                                </td>
                            </tr>
                        
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
