<?php

namespace App\Interfaces\Project;

interface ProjectRepositoryInterface
{
    public function index();
    public function validation($request);
    public function store($request);
    public function destroy($request);

}