<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Interview</title>
<link rel="stylesheet" type="text/css" href="../_/css/interview.css" />
<link rel="shortcut icon" href="../img/texas_flag.png" />
<script type="text/javascript" src="../_/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../_/js/interview.js"></script>
</head>
<body>

<div class="container">

    <span class="tag"><?php echo $job_title . ' with ' . $company; ?></span>

    <div class="icon <?php echo $type; ?>"></div>

    <div class="date">
        <?php echo $date . '<br />' . $time; ?>
    </div>

    <h2 class="centered">
        <?php echo $interviewer_title . ' - ' . $interviewer_name; ?>
    </h2>

    <div class="content">

        <?php
        foreach ( $interviews as $i ) {
            $i->render_meta();
        }
        ?>

    </div>

</div>

</body>
</html>
