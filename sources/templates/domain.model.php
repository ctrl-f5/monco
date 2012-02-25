<?php /** @var $class \Monco\Modeling\Model\ClassModel */ ?>
<?php /** @var $properties \Monco\Modeling\Data\Property[] */ ?>

namespace <?php echo $class->getFullNamespace() ?>;

class <?php $class->getClassName() ?> extends \My\Domain\Model
{
    <?php foreach ($properties as $p): ?>
    /**
     * @var <?php echo $p->getType(); ?>
     */
    private $_<?php echo $p->getNameCamelCased(); ?>;

    <?php endforeach; 
    foreach ($properties as $p): ?>
    /**
     * @return <?php echo $p->getType(); ?>
     */
    <?php echo $p->getGetterDeclaration(); ?>
    {
        return $this->_<?php echo $p->getNameCamelCased(); ?>;
    }

    /**
     * @return <?php echo $class->getClassName(); ?>
     */
    <?php echo $p->getSetterDeclaration(); ?>
    {
        $this->_<?php echo $p->getNameCamelCased(); ?> = <?php echo $p->getVariableDeclaration(); ?>;
        return $this;
    }

    <?php endforeach; ?>
}
