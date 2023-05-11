<?php

namespace App\Data;

interface CrudInterfaceData
{
    public function getEntity(): object;

    public function getFormClass(): string;

    public function hydrate(): void;
}