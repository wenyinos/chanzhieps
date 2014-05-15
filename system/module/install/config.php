<?php
$config->install = new stdclass();
$config->install->latestReleaseApi = 'http://api.chanzhi.org/latestrelease.php?from=v' . $this->config->version;
