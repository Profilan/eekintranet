<?php

namespace ProUser\Mapper;

interface UserInterface
{
    public function findAll();
    
    public function findByEmail($email);

    public function findByUsername($username);

    public function insert($user);

    public function update($user);
}
