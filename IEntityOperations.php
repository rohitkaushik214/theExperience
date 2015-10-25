<?php

interface IEntityOperations {

    public function getEntity($iID);
    public function insertEntity($aProperties);
    public function deleteEntity($iID);
    public function updateEntity($iID, $aProperties);
}