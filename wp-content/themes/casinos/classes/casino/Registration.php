<?php
namespace Classes\Casino;

abstract class Registration{
    abstract protected function registration():void;
    abstract protected function getEssenceData():array;
}