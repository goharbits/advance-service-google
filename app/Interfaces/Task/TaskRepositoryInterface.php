<?php

namespace App\Interfaces\Task;

interface TaskRepositoryInterface
{
    public function index();
    public function validation($request);
    public function store($request);
    public function destroy($request);
    public function updatePriority($request);
    public function show($id);

}