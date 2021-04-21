<?php

namespace App;

interface Serializable
{
    public function serialize(): array;
}