<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Interview Aide</title>
<link rel="styleSheet" type="text/css" href="_/css/aide.css">
<link rel="shortcut icon" href="img/suit.png" />
<script type="text/javascript" src="_/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="_/js/aide.js"></script>
</head>
<body>

<div class="top-buttons" id="start">
    START RECORDING
</div>

<div class="top-buttons hidden" id="stop">
    STOP RECORDING
</div>

<br />

<div id="report" class="hidden">

    <div class="log-notification">
        <b>CONGRATULATIONS</b> ON GETTING THROUGH THE INTERVIEW!! <br /> Don't forget to <b>LOG</b> the session history (below).
    </div>

    <div class="summary" id="summary"></div>

    <br />

</div>


<div class="topic no-border">

    <div class="talking-point question">

        <div class="title"><?php echo $job_title . ' with ' . $company . ' - ' . $interviewer_name . ' (' . $interviewer_title . ')'; ?></div>

        <div class="answer">

            <?php

            foreach ( $interviews as $i ) {
                $i->render_meta();
            }

            ?>

        </div>

    </div>

</div>

<br />


<div class="top-buttons open mgmt hidden">
    OPEN ALL
</div>


 <div class="top-buttons close mgmt">
    CLOSE ALL
</div>

<br />

<div class="generic">

    <?php

    foreach ( $aide as $topic => $category ) {

        $title = array_shift( $category );
        render_topic( $title, $topic );

        foreach ( $category as $cat ) {

            $cat->render_section( $topic );

        }

    }

    ?>

</div>

<br />

<div class="top-buttons close mgmt">
    CLOSE ALL
</div>

</body>
</html>
