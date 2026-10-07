<?php
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
$target = $scriptDir === '' ? '/admin/login.php' : $scriptDir . '/admin/login.php';
header('Location: ' . $target, true, 302);
exit;
