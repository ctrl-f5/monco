<?php

namespace Monco\Modeling\Model;

class FunctionModel
{
    const ACCESSOR_PUBLIC       = 'public';
    const ACCESSOR_PROTECTED    = 'protected';
    const ACCESSOR_PRIVATE      = 'private';

    public function getAccessor() {}

    public function getFunctionName() {}

    public function getParameters() {}

    public function getParameterDeclarations () {}

    public function getTemplateFile() {}

    public function getCodingStandard() {}

    public function render() {}
}
