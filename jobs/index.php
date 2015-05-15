<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Austin Job Search</title>
<link rel="stylesheet" type="text/css" href="jobs/_/css/jobs.css">
<link rel="stylesheet" type="text/css" href="jobs/_/css/font-awesome.min.css">
<link rel="shortcut icon" href="jobs/img/texas_flag.png" />
<script type="text/javascript" src="jobs/_/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jobs/_/js/jobs.js"></script>
</head>
<body>

<?php
require_once 'functions.php';
require_once 'applications.php';
?>

<div id="page_wrap">

    <?php render_links( 'links', $links ); ?>
    <?php render_links( 'jobs', $list ); ?>
    <?php render_links( 'companies', $companies ); ?>

    <div class="section">
        <h2 id="apply_count" class="count">applied</h2>
        <?php Job::render( $jobs, 'applications' ); ?>
    </div>

    <div class="section">
        <h2>potential<span class="last">Last search: <?php echo $last_search; ?></span></h2>
        <?php Job::render( $jobs, 'potentials' ); ?>
    </div>

</div>

</body>
</html>
