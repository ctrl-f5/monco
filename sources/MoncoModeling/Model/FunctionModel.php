<?php

namespace Monco\Modeling\Model;

class FunctionModel
{
    const ACCESSOR_PUBLIC       = 'public';
    const ACCESSOR_PROTECTED    = 'protected';
    const ACCESSOR_PRIVATE      = 'private';

    private $_accessor;

    private $_functionName;

    private $_parameters;

    private $_templateFile;

    private $_codingStyle;

    public function getAccessor() {}

    public function getFunctionName() {}

    public function getParameters() {}

    public function getParameterDeclarations () {}

    public function getTemplateFile() {}

    public function getCodingStyle() {}

    public function render() {}
}
