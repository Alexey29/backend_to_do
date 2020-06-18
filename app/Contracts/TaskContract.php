<?php


namespace App\Contracts;


interface TaskContract
{
    public function getAll();

    public function getOne(int $id);

    public function create(array $conditions);

    public function update(array $conditions);

    public function delete(int $id);
}
