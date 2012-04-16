<?php
/** @var $template \Monco\Modeling\Template\Template */
foreach ($template->getData() as $d) {
    echo $d->getName();
}