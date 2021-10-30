<?php

namespace App\Repository;

interface studentrepositoryinterface {

    public function create_teacher_page();

    public function students_store ($request);

    public function index();

    public function edit($id);

    public function update($request,$id);

    public function delete($request);



}