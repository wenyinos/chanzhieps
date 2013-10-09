<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <hr/>
  <footer>
    <?php 
    echo "&copy; {$config->company->name} {$config->site->copyright}-" . date('Y') . '&nbsp;&nbsp;';
    echo $config->site->icp;
    printf($lang->poweredBy, $config->version, $config->version);
    ?>
  </footer>
   
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);
?>
</div>
</body>
</html>
