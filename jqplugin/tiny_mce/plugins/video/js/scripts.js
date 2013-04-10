// @name scripts
// @author Darius Matulionis <darius@matulionis.lt>

tinyMCEPopup.requireLangPack();
var VideoDialog = {
  init: function () {
  },
  preview:function(){
    var link_embed=$('#video_path').val();
    var link_embed='<iframe frameborder="0" scrolling="0" width="420" height="200" src="'+tinyMCE.activeEditor.getParam('document_base_url')+'Player/load?link='+link_embed+'&autoplay=1"></iframe>';
    if(link_embed!=''){
      $('#prev').html(link_embed);
    }
  },
    // Insert the contents from the input into the document
    insert: function () {
      var link_embed=$('#video_path').val();
      var array_link=link_embed.split('/');
      var video_name=array_link[array_link.length-1];
      var directory_path=link_embed.replace(video_name,'');
      var thumb_name=video_name.substr(0, video_name.lastIndexOf("."))+'.jpg';
      var thumb_link=directory_path+'thumb/'+thumb_name;
      var link_embed='<iframe  frameborder="0" allowfullscreen width="420" height="200" src="'+tinyMCE.activeEditor.getParam('document_base_url')+'Player/load?link='+link_embed+'&thumb='+thumb_link+'&autoplay=1"></iframe>';
      tinyMCEPopup.editor.execCommand('mceInsertContent', false, link_embed);
      tinyMCEPopup.close();
    }
  };
  tinyMCEPopup.onInit.add(VideoDialog.init, VideoDialog);


