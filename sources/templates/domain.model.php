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
    <?php endforeach; ?>

    <?php foreach ($properties as $p): ?>
    /**
     * @return <?php echo $p->getType(); ?>
     */
    public function get<?php echo $p->getNamePascalCased(); ?>()
    {
        return $this->_<?php echo $p->getNameCamelCased(); ?>;
    }

    /**
     * @return <?php echo $class->getClassName(); ?>
     */
    public function set<?php echo $p->getNamePascalCased(); ?>($<?php echo $p->getNameCamelCased(); ?>)
    {
        $this->_<?php echo $p->getNameCamelCased(); ?> = $<?php echo $p->getNameCamelCased(); ?>;
        return $this;
    }

    <?php endforeach; ?>
}