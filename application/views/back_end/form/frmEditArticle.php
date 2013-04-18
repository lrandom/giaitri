<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<?php
$CI -> load -> view('back_end/includes/header.php');
?>
<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" language="JavaScript" src="<?php echo base_url() ?>jqplugin/token_input/src/jquery.tokeninput.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>/jqplugin/ui/js/jquery-ui-1.8.17.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>jqplugin/ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>jqplugin/token_input/styles/token-input.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>jqplugin/token_input/styles/token-input-facebook.css" />
<script type="text/javascript">
var arrayTag=[];
var idOfRel=[];
function fileBrowser (field_name, url, type, win) {
  var elfinder_url='';
  if(type=='<?php echo VIDEO_UPLOAD_LABEL ?>'){
    elfinder_url='<?php echo $video_upload_controller ;?>';
}

if(type=='<?php echo IMAGE_UPLOAD_LABEL ?>'){
    elfinder_url = '<?php echo $image_upload_controller ; ?>';   
}
    // use an absolute path!
    tinyMCE.activeEditor.windowManager.open({
     file: elfinder_url,
     title: 'Duyệt file để chèn vào bài viết',
     width: 900,  
     height: 450,
     resizable: 'yes',
         inline: 'yes',    // This parameter only has an effect if you use the inlinepopups plugin!
         popup_css: false, // Disable TinyMCE's default popup CSS
         close_previous: 'no'
     }, {
       window: win,
       input: field_name,
       type: type
   });
    return false;
}



tinyMCE.init({
   width: "1000",
   height: "1000",
   mode : "exact",
   relative_urls : false,
   remove_script_host : false,
   convert_urls : false, 
   elements: "txtContent",
   plugins : "video,youtubeIframe,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
    	 //Theme options
    	 theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    	 theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    	 theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,advhr,|,print,|,ltr,rtl,|,fullscreen",
    	 theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
    	 theme_advanced_buttons5 : "video,youtubeIframe,image",
    	 theme_advanced_toolbar_location : "top",
    	 theme_advanced_toolbar_align : "left",
    	 theme_advanced_statusbar_location : "bottom",
    	 theme_advanced_resizing : true,
    	 file_browser_callback : 'fileBrowser'
    	});



 ////////////////////////////////////////JQUERY START////////////////////////////////////////
 $(document).ready(function() {
 	var required_messager = "Vui lòng không bỏ trống dòng này";
 	var digits_messager = "Vui lòng chỉ điền số";
 	$('#form-add-article').validate({
 		rules : {
 			txtTitle : {
 				required : true,
 				maxlength : 500
 			},
 			txtSource : {
 				required : true
 			},
 			txtAuthor : {
 				required : true
 			},

 			txtIntro:{
 				required:true
 			},

            txtDatePost:{
                required:true
            }
        },
        messages : {
            txtTitle : {
               required : required_messager,
               maxlength : "Độ dài kí tự phải nhỏ hơn 500 kí tự"
           },
           txtSource : {
               required : required_messager
           },
           txtAuthor : {
               required : required_messager
           },

           txtIntro:{
               required:required_messager
           },
           txtDatePost:{
            required:required_messager
        }
    },
    errorClass : "help-inline",
    errorElement : "span",
    highlight : function(element, errorClass, validClass) {
        $(element).parents('.control-group').removeClass('success');
        $(element).parents('.control-group').addClass('error');
    },
    unhighlight : function(element, errorClass, validClass) {
        $(element).parents('.control-group').removeClass('error');
        $(element).parents('.control-group').addClass('success');
    },
    submitHandler: function(form) {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        var content=tinyMCE.activeEditor.getContent();

        if(content==''){
           alert('Vui lòng điền nội dung bài viết');
           return;
       }

       if(content.length <100  || content.length>50000){
           alert('Nội dung bài viết từ 100 đến 50000 kí tự');
           return;
       }

       if($('#thumb-data').val()==''){
           alert('Vui lòng chọn ảnh đại diện');
           return;
       }

       if($("#cat-wrap :checkbox").filter(":checked").size()==0){
           alert('Vui lòng chọn chọn chuyên mục');
           return;
       }

       var tmp='';
       if(arrayTag.length!=0){
           for(i=0;i<arrayTag.length;i++){
              tmp+=arrayTag[i]+'|';
          }
      }
      $('#set-of-tag').val(tmp);

      tmp='';
      if(idOfRel.length!=0){
       for(i=0;i<idOfRel.length;i++){
          tmp+=idOfRel[i]+'|';
      }
  }
  $('#set-of-rel-article').val(tmp);

  form.submit();
}
});

$('#thumb').bind('click',function(){
    $('#thumbModal').modal({
        remote:'<?php echo $thumb_upload_controller ;?>'
    })
})



$("#txtRelArticle").tokenInput("<?php echo $relative_article_controller;  ?>", {
	preventDuplicates : true,
	searchingText : "Đang tìm...",
	propertyToSearch : "title",
	hintText : "Nhập tiêu đề bài viết liên quan",
	noResultsText : "Không có kết quả",
	prePopulate:[
	<?php
	if($rel_article!=null){
		for ($i=0; $i < count($rel_article) ; $i++) {
			?>
			{id: <?php echo $rel_article[$i][0]->id ?>, title: "<?php echo $rel_article[$i][0]->title; ?>"},
			<?php
		}
	}
	?>
	],
	onAdd : function(item) {
		idOfRel.push(item.id);
	},
	onDelete : function(item) {
		for ( i = 0; i < idOfRel.length; i++) {
			if (idOfRel[i] == item.id) {
				idOfRel.splice(i,1);
			}
		}
	}
});


$("#txtTag").tokenInput("<?php echo  $get_tag_controller; ?>", {
	preventDuplicates : true,
	searchingText : "Đang tìm...",
	propertyToSearch : "name",
	hintText : "Nhập tên tag",
	noResultsText : "Không có kết quả",
	onAdd : function(item) {
		arrayTag.push(item.id);
	},
	prePopulate: [
	<?php
	if($tags!=null){
		foreach ($tags as $r) {
			?>
			{id: <?php echo $r->id ?>, name: "<?php echo $r->name; ?>"},
			<?php
		}
	}
	?>
	],
	theme: "facebook",
	onDelete : function(item) {
		for ( i = 0; i < arrayTag.length; i++) {
			if (arrayTag[i] == item.id) {
				arrayTag.splice(i,1);
			}
		}
	}
});

<?php
if($rel_article!=null ){
	for ($i=0; $i < count($rel_article) ; $i++) {
		?>
		idOfRel[<?php echo $i ?>]=<?php echo $rel_article[$i][0]->id?>;
		$("#txtRelArticle").tokenInput("add", {id: <?php echo $rel_article[$i][0]->id ?>, title: "<?php echo $rel_article[$i][0]->title; ?>"});
		<?php
	}
}
?> 

<?php
if($tags!=null){
	for ($i=0; $i < count($tags) ; $i++) {
		?>
		arrayTag[<?php echo $i ?>]=<?php echo $tags[$i]->id?> ;
		<?php
	}
}
?> 



$('#btnAddTag').bind('click',function(){
	var tag_name=$('#txtAddTag').val();
	$.ajax({
		url: '<?php echo $add_tag_controller; ?>',
		type: 'POST',
		dataType: 'html',
		data:{txtTagName:tag_name},
		success: function (data) {
			$('#txtAddTag').val('');
		}
	})
})

$( "#txtDatePost" ).datepicker({
    'minDate':0,
    'dateFormat':'dd-mm-yy'
});

})
    //end jquery
    </script>
    <style type="text/css">
    .modal {
    	position: fixed;
    	top: 0;
    	right: 0;
    	bottom: 100%;
    	left: 0;
    	margin: 0;
    	width: 100%;
    	height: 100%;
    }
    .modal-body {
    	max-height: 100%;
    }
    .modal.fade.in {
    	top: 0;
    }
    ul.token-input-list{
    	margin-left: 0px;
    	float: left;
    	margin-top: -30px;
    	width: 312px;
    }

    ul.token-input-list-facebook{
    	margin-left: 0px;
    	float: left;
    	margin-top: -30px;
    	width: 312px;
    	-moz-border-radius:5px;
    	border: 1px solid #CCCCCC;


    }
    </style>
    <body>
    	<?php
    	$CI -> load -> view('back_end/includes/nav_menu');
    	?>
    	<div class="container-fluid wrapper">
    		<form class="form-horizontal" id="form-add-article" method="post">
    			<input type="hidden" value="" id="set-of-tag" name="set-of-tag" />
    			<input type="hidden" value="" id="set-of-rel-article" name="set-of-rel-article"/>
    			<fieldset>
    				<legend>
    					Đăng bài viết
    				</legend>

    				<div class="control-group">
    					<label class="control-label" for="txtTitle">Tiêu đề</label>
    					<div class="controls">
    						<input type="text" id="txtTitle" name="txtTitle" value="<?php echo $article[0]->title ?>"/>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="thumb">Ảnh minh họa</label>
    					<div class="controls">
    						<img src="<?php 
    						if($article[0]->thumb!=null){
    							echo base_url().$article[0]->thumb;
    						}else{
    							echo base_url().THUMB_DEFAULT_PATH;
    						}
    						?>" width="100px" height="100px" id="thumb" name="thumb"/>
    						<input type="hidden" id="thumb-data" name="thumb-data" value="<?php echo $article[0]->thumb; ?>"/>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtCat">Chuyên mục</label>
    					<div class="controls">
    						<div id="cat-wrap" style="height: 150px; width: 300px; ;overflow-y:scroll; background: #FFFFFF; border: 1px solid #CCCCCC; padding: 5px">
    							<?php
    							$cat_select_pattern=str_replace('|', '', $article[0]->cat_id);
    							foreach($cat_list as $r){
    								echo '<div><input type="checkbox" name="txtCat[]" value="'.$r->id.'" ';
    								if(preg_match('/'.$r->id.'/',$cat_select_pattern)){
    									echo 'checked="checked"';
    								}
    								echo ' style="float:left"/><span style="margin-left:5px;">'.$r->name.'</span></div>';
    							}
    							?>
    						</div>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtSource">Nguồn</label>
    					<div class="controls">
    						<input type="text"  id="txtSource" name="txtSource" value="<?php echo $article[0]->source; ?>">
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtAuthor">Tác giả</label>
    					<div class="controls">
    						<input type="text" id="txtAuthor" name="txtAuthor" value="<?php echo $article[0]->author ?>"/>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtContent">Tin liên quan</label>
    					<div class="controls">
    						<input type="text" name="txtRelArticle" id="txtRelArticle" />
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtTag">Tag</label>
    					<div class="controls">
    						<input type="text" name="txtTag" id="txtTag" class="inline"/>
    					</div>
    				</div>


    				<div class="control-group" style="margin-top: -15px;">
    					<div class="controls" > 		
    						<div class="input-append">
    							<input class="span2" id="txtAddTag" type="text" name="txtAddTag" style="width: 215px">
    							<button class="btn" type="button" id="btnAddTag">Thêm tag</button>
    						</div>     					
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtIntro">Giới thiệu</label>
    					<div class="controls">
    						<textarea id="txtIntro" name="txtIntro" style="width: 985px"><?php echo $article[0]->intro; ?></textarea>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtContent">Nội dung</label>
    					<div class="controls">
    						<textarea id="txtContent" name="txtContent"><?php echo $article[0]->content; ?></textarea>
    					</div>
    				</div>

    				<div class="control-group">
    					<label class="control-label" for="txtState">Duyệt</label>
    					<div class="controls">
    						<select id="txtState" name="txtState">
    							<option value="<?php echo ACTIVED_STATE ?>" <?php (($article[0]->state==ACTIVED_STATE)?'selected="selected"':'');  ?> >Duyệt</option>
    							<option  value="<?php echo DISABLED_STATE ?> <?php (($article[0]->state==DISABLED_STATE)?'selected="selected"':'');  ?>">Loại</option>
    						</select>
    					</div>
    				</div>


                    <div class="control-group">
                        <label class="control-label" for="txtDatePost">Ngày đăng</label>
                        <div class="controls">
                            <input type="text" name="txtDatePost" id="txtDatePost" value="<?php 
                               echo date('d-m-Y',strtotime($article[0]->date_post));
                             ?>" />
                        </div>
                    </div>

                    <div class="control-group">
                     <div class="controls">
                      <button type="submit" class="btn">
                       <?php
                       echo EDIT_LABEL;
                       ?>
                   </button>
                   <a class="btn" href="<?php echo $back_link; ?>">
                       <?php
                       echo BACK_LABEL;
                       ?>
                   </a>
               </div>
           </div>
       </fieldset>
   </form>
   <!--end form-->
</div>

<!--BROWSER THUMBNAIL MODAL-->
<div id="thumbModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   <h3 id="myModalLabel">Chọn ảnh đại diện</h3>
</div>
<div class="modal-body">
   <p>Loading...</p>
</div>
<div class="modal-footer">
   <button class="btn btn btn-inverse" data-dismiss="modal" aria-hidden="true">Đóng</button>
</div>
</div>
</body>
</html>