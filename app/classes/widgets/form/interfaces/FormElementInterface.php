<?php
namespace app\classes\widgets\form\interfaces;

interface FormElementInterface {
    public function setName($name);
    public function getName();
    public function setValue($value);
    public function getValue();
    public function show();
}
