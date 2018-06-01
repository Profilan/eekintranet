<?php

namespace ProUser\Mapper;

interface GroupInterface
{
    public function findAll();
    
    public function findByDistinguishedname($distinguishedname);
    
    public function findByName($name);

    public function insert($group);

    public function update($group);
}
