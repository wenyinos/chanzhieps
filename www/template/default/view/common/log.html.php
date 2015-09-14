<script>
var referer         = "<?php echo urlencode($this->server->http_referer);?>";
var browserLanguage = navigator.language || navigator.userLanguage; 
var resolution      = screen.availWidth + ' X ' + screen.availHeight;
$.post(createLink('log', 'record'), {referer:referer, browserLanguage:browserLanguage, resolution:resolution});
</script>
