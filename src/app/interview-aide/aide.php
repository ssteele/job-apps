<?php

namespace SteveSteele\Aide;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Interview Aide</title>
<link rel="shortcut icon" href="/<?php route([AIDE_PATH, '/_/img/suit.png'], 'png'); ?>" />
<link rel="stylesheet" type="text/css" href="/<?php route([APP_PATH, '/_/css/foundation-5.5.2.min.css'], 'css'); ?>">
<link rel="stylesheet" type="text/css" href="/<?php route([AIDE_PATH, '/_/css/aide.css'], 'css'); ?>">
<script type="text/javascript" src="/<?php route([APP_PATH, '/_/js/jquery-2.1.1.min.js'], 'js'); ?>"></script>
<script type="text/javascript" src="/<?php route([APP_PATH, '/_/js/foundation-5.5.2.min.js'], 'js'); ?>"></script>
<script type="text/javascript" src="/<?php route([AIDE_PATH, '/_/js/aide.js'], 'js'); ?>"></script>
</head>
<body>

<?php
require_once route([JOBS_PATH, '/interview-aide/current-interview-specific.php']);
require_once route([JOBS_PATH, '/interview-aide/general-question-answer.php']);
$aide->setPartialPath(route([AIDE_PATH, '/partials/']));
?>

<div class="row">
    <div class="small-12 columns record start button" id="start">START RECORDING</div>
</div>

<div class="row">
    <div class="small-12 columns record stop button hidden" id="stop">STOP RECORDING</div>
</div>

<div class="row">
    <div id="report" class="small-12 columns report full-width hidden">

        <div class="notification centered">
            <div><span class="bold">CONGRATULATIONS</span> ON GETTING THROUGH THE INTERVIEW!!</div>
            <div>Don't forget to <span class="bold">LOG</span> the session history (below).</div>
        </div>

        <div class="summary" id="summary"></div>

        <div class="summary-markup" id="summary-markup"></div>

    </div>
</div>

<div class="row topic">
    <div class="small-12 columns current question">

        <div class="job-title"><?php echo $jobTitle . ' with ' . $company . ' - ' . $interviewerName . ' (' . $interviewerTitle . ')'; ?></div>

        <div class="answer">

            <?php
            foreach ($interviews as $interview) {
                $interview->renderMeta();
            }
            ?>

        </div>

    </div>
</div>

<div class="row">
    <div class="small-12 columns button open mgmt hidden">OPEN ALL</div>
</div>

<div class="row">
    <div class="small-12 columns button close mgmt">CLOSE ALL</div>
</div>

<?php $aide->render(); ?>

<div class="row">
    <div class="small-12 columns button close mgmt">CLOSE ALL</div>
</div>

</body>
</html>
