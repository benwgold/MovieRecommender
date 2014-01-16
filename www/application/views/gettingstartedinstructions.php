<div class='gettingStartedWrapper'>
    <h4 class='stepsheader'>    Step <?php echo $step; ?> of 3

    </h4>

    <div class="progress progress-striped active">
        <div class="bar" style="width: <?php echo ($step/$totalSteps*100); ?>% ;"></div>
    </div>
    <div class='instructionswrapper'>
    <h3 class="title"><?php echo $title; ?></h3>
    <h5 class="subTitle"><?php echo $subTitle; ?></h5>
     <?php if($step == 1):?>
     </br>
     <span class='muted' id='howmanymoretext'> </span>
     <a href=<?php echo site_url() . "/gettingstarted/step/" . ($step+1); ?>>
     <button class='btn-large success' id='nextButton'>

            Next ->

    </button>
     </a>

    <?php endif; ?>
    </div>
</div>
