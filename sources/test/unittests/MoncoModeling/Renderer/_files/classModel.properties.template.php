<?php /** @var $template \Monco\Modeling\Template\ClassModel */ ?>

<?php echo $template->getNamespaceDeclaration(); ?>;

class <?php echo $template->getClassModel()->getClassName().PHP_EOL; ?>
{
    <?php echo $template->renderPropertyDeclarations($template->getData(), '_').PHP_EOL; ?>

    <?php echo $template->renderGettersAndSetters($template->getData()).PHP_EOL; ?>
}