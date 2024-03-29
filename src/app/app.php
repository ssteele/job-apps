<?php

namespace SteveSteele\JobApp;

use SteveSteele\JobApp\Job;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Austin Job Search</title>
<link rel="shortcut icon" href="/<?php route([APP_PATH, '/_/img/texas_flag.png'], 'png'); ?>" />
<link rel="stylesheet" type="text/css" href="/<?php route([APP_PATH, '/_/css/foundation-5.5.2.min.css'], 'css'); ?>">
<link rel="stylesheet" type="text/css" href="/<?php route([APP_PATH, '/_/css/font-awesome.min.css'], 'css'); ?>">
<link rel="stylesheet" type="text/css" href="/<?php route([APP_PATH, '/_/css/jobs.css'], 'css'); ?>">
<script type="text/javascript" src="/<?php route([APP_PATH, '/_/js/jquery-2.1.1.min.js'], 'js'); ?>"></script>
<script type="text/javascript" src="/<?php route([APP_PATH, '/_/js/foundation-5.5.2.min.js'], 'js'); ?>"></script>
<script type="text/javascript" src="/<?php route([APP_PATH, '/_/js/jobs.js'], 'js'); ?>"></script>
</head>
<body>

<?php
require_once route([JOBS_PATH, '/applications/archives.php']);
require_once route([JOBS_PATH, '/applications/applications.php']);
require_once route([JOBS_PATH, '/applications/meta.php']);
?>

<header></header>

<div class="row">
    <div class="small-12 columns">

        <?php echo renderLinks('links', $links); ?>
        <?php echo renderLinks('lists', $lists); ?>
        <?php echo renderLinks('companies', $companies); ?>

        <div class="section">
            <h2 id="apply-count" class="count">applied</h2>
            <?php isset($jobs) ? Job::render('applications', $jobs) : ''; ?>
        </div>

        <div class="section">
            <h2 id="potential-count" class="count">potential<span class="last">Last search: <?php echo $lastSearch; ?></span></h2>
            <?php isset($jobs) ? Job::render('potentials', $jobs) : ''; ?>
        </div>

        <div id="info-panel">
            <span></span>
        </div>

    </div>
</div>

<footer></footer>

</body>
</html>
