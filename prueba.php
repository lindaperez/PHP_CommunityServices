<?
session_start();
require "cAutorizacion.php";
include "cNotificarCulminacion.php";
//include_once("cVerifInscrito.php");
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Notificar Culminacion - SERVICIO COMUNITARIO</title>
<?php include_once("vHeader.php"); ?>
<script language="javascript" src="cVerifCulminacion.js"></script>

<!-- Load jQuery
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1");
</script>-->

<!-- Load TinyMCE -->
<script type="text/javascript" src="../Formularios/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '../Formularios/tinymce/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,search,replace,|,outdent,indent,|,undo,redo,|,bullist,numlist,|,charmap,fullscreen",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "../Formularios/tinymce/examples/css/content.css"
		});
	});
</script>
<!-- /TinyMCE -->

<form method="post" action="http://tinymce.moxiecode.com/dump.php?example=true">
	<div>
		<h3>Full featured example using jQuery plugin</h3>

		<p>
			This example shows how TinyMCE can be lazy loaded using jQuery. The jQuery plugin will also attach it's self to various jQuery methods to make it more easy to get/set editor contents etc.
		</p>

		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%" class="tinymce">
				&lt;p&gt;
					This is some example text that you can edit inside the &lt;strong&gt;TinyMCE editor&lt;/strong&gt;.
				&lt;/p&gt;
				&lt;p&gt;
				Nam nisi elit, cursus in rhoncus sit amet, pulvinar laoreet leo. Nam sed lectus quam, ut sagittis tellus. Quisque dignissim mauris a augue rutrum tempor. Donec vitae purus nec massa vestibulum ornare sit amet id tellus. Nunc quam mauris, fermentum nec lacinia eget, sollicitudin nec ante. Aliquam molestie volutpat dapibus. Nunc interdum viverra sodales. Morbi laoreet pulvinar gravida. Quisque ut turpis sagittis nunc accumsan vehicula. Duis elementum congue ultrices. Cras faucibus feugiat arcu quis lacinia. In hac habitasse platea dictumst. Pellentesque fermentum magna sit amet tellus varius ullamcorper. Vestibulum at urna augue, eget varius neque. Fusce facilisis venenatis dapibus. Integer non sem at arcu euismod tempor nec sed nisl. Morbi ultricies, mauris ut ultricies adipiscing, felis odio condimentum massa, et luctus est nunc nec eros.
				&lt;/p&gt;
			</textarea>
		</div>

		<!-- Some integration calls -->
		<a href="javascript:;" onclick="$('#elm1').tinymce().show();return false;">[Show]</a>
		<a href="javascript:;" onclick="$('#elm1').tinymce().hide();return false;">[Hide]</a>
		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('Bold');return false;">[Bold]</a>
		<a href="javascript:;" onclick="alert($('#elm1').html());return false;">[Get contents]</a>
		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getContent());return false;">[Get selected HTML]</a>
		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getContent({format : 'text'}));return false;">[Get selected text]</a>
		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getNode().nodeName);return false;">[Get selected element]</a>
		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('mceInsertContent',false,'<b>Hello world!!</b>');return false;">[Insert HTML]</a>
		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('mceReplaceContent',false,'<b>{$selection}</b>');return false;">[Replace selection]</a>

		<br />
		<input type="submit" name="save" value="Submit" />
		<input type="reset" name="reset" value="Reset" />
	</div>
</form>
<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>
</body>
</html>