<?php
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
$target = $scriptDir === '' ? '/admin/logout.php' : $scriptDir . '/admin/logout.php';
header('Location: ' . $target, true, 302);
exit;
