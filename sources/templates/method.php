function <?php echo $this->property->getFunctionName('get'); ?>(<?php echo $this->property->getParameterDeclaration(); ?>) {
<?php if ($this->function->checkType) : ?>
    <?php //switch ($this->function->id): ?>
    if (!is_int(<?php echo $this->property->getParameterVar(); ?>)) {
        //if function should throw exception throw it else false
    }
<?php endif; ?>
}
