<?php
$config->address = new stdclass();
$config->address->require = new stdclass();
$config->address->require->create = 'account,address,phone,zipcode,contact';
$config->address->require->edit   = 'account,address,phone,zipcode,contact';
