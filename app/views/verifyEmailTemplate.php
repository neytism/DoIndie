<?php ob_start(); ?>
<p>Hi there, </p>
<p>This is your one time verification code.</p>

<div style="background-color: #dbdbdb; width 100%; text-align: center; border-radius: 20px; height: 75px; line-height: 75px;">
    <h1 style="letter-spacing: 10px;"><?=$code?></h1>
</div>

<p>This code is only active for the next 3 minutes. Once the code expires you will have to resubmit a request for a code.</p><br>
<p>Keep making awesome stuff!</p>
<p>Doindie</p>

<?php
$message = ob_get_clean();
return $message;