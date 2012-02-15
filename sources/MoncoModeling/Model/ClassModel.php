<?php

namespace Monco\Modeling\Model;

class ClassModel
{
    const CLASS_TYPE_INTERFACE  = 'interface';
    const CLASS_TYPE_ABSTRACT   = 'abstract';
    const CLASS_TYPE_CONCRETE   = 'concrete';

    private $_id;

    private $_fullClassName;

    private $_ClassType;

    private $_destinationDirectory;

    private $_namespaceDestinationDirectory;

    private $_subdirectory;

    private $_parentClass;

    private $_interfaces;

    private $_templateFile;

    private $_codingStyle;

    public function getId() {}

    public function getFullClassName() {}

    public function getClassName() {}

    public function getClassNamespace() {}

    public function isInterface() {}

    public function isAbstract() {}

    public function isConcrete() {}

    public function getDestinationDirectory() {}

    public function getNamespaceDestinationDirectory() {}

    public function hasSubdirectory() {}

    public function getSubdirectory() {}

    public function hasParentClass() {}

    public function getParentClass() {}

    public function hasInterfaces() {}

    public function getInterfaces() {}

    public function getTemplateFile() {}

    public function getCodingStyle() {}

    public function render() {}
}