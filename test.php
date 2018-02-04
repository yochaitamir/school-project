<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#f').live('change' ,function(){
           $('#fo').ajaxForm({target: '#d'}).submit();
                      });


    });
// });
</script>
<form id="fo" name="fo" action="nextimg.php" enctype="multipart/form-data" method="post">
 <input type="file" name="f" id="f" value="start upload" />
<input type="submit" name="sub" value="upload"/>
</form>
<div id="d"></div>