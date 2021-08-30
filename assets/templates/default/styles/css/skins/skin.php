<?php

$skin = $_GET['skin'];

header("Content-type: text/css; charset: UTF-8");

if (empty($skin))
    $skin = 'default';

$output = <<<HTML

.toggle-label { background-image: url("{$skin}/toggle-button-plus.png"); }

.active-toggle .toggle-label { background-image: url("{$skin}/toggle-button-minus.png"); }

.pricing-table .plan-details li i.tick { background-image: url({$skin}/tick.png); }

.pricing-table .plan-details li i.cross { background-image: url({$skin}/cross.png); }

.contact-form .button i.send { background-image: url({$skin}/send-icon.png); }
    
#featured-sources .heading2 .title { background-image: url({$skin}/featured-icon.png)}

.tp-bullets.simplebullets.round .bullet { background-image: url({$skin}/bullet.png); }

@media only screen and (-webkit-min-device-pixel-ratio: 2) {

    .pricing-table .plan-details li i.tick { background-image: url({$skin}/tick@2x.png); }

    .pricing-table .plan-details li i.cross { background-image: url({$skin}/cross@2x.png); }

    .contact-form .button i.send { background-image: url({$skin}/send-icon@2x.png);}

    #featured-sources .heading2 .title { background-image: url({$skin}/featured-icon@2x.png)}

}


HTML;

echo $output;
?>