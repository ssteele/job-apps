<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Interview</title>
<link rel="shortcut icon" href="/<?php route( [INTERVIEW_PATH, '_/img/texas_flag.png'], 'png' ); ?>" />
<link rel="stylesheet" type="text/css" href="/<?php route( [APP_PATH, '_/css/foundation-5.5.2.min.css'], 'css' ); ?>">
<link rel="stylesheet" type="text/css" href="/<?php route( [INTERVIEW_PATH, '_/css/interviews.css'], 'css' ); ?>">
<script type="text/javascript" src="/<?php route( [APP_PATH, '_/js/jquery-2.1.1.min.js'], 'js' ); ?>"></script>
<script type="text/javascript" src="/<?php route( [APP_PATH, '_/js/foundation-5.5.2.min.js'], 'js' ); ?>"></script>
<script type="text/javascript" src="/<?php route( [INTERVIEW_PATH, '_/js/interviews.js'], 'js' ); ?>"></script>
</head>
<body>

<?php
$file = sanitize_input( urldecode( $_GET['i'] ), 's' ) . '.php';
require_once route( [JOBS_PATH, 'interviews/' . $file] );
?>

<div class="row">
    <div class="small-12 columns container">

        <div class="head">

            <span class="title"><?php echo $job_title . ' with ' . $company; ?></span>

            <div class="medium icon show-for-medium-up <?php echo $type; ?>"></div>
            <div class="small icon hide-for-medium-up <?php echo $type; ?>"></div>

            <div class="timestamp">
                <span class="date"><?php echo $date; ?></span>
                <span class="time"><?php echo $time; ?></span>
            </div>

            <h2 class="centered">
                <?php echo $interviewer_title . ' - ' . $interviewer_name; ?>
            </h2>

        </div>

        <div class="row">

            <div class="small-12 medium-10 medium-centered columns content">
                <?php
                foreach ( $interviews as $i ) {
                    $i->render_meta();
                }
                ?>
            </div>

        </div>

    </div>
</div>

</body>
</html>
