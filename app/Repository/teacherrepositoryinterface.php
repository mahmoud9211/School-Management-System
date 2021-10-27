<?php

namespace App\Repository;


interface teacherrepositoryinterface {

public function getteachers();

public function teacher_create_page();

public function teacher_store($request);

public function edit($id);

public function update($request,$id);

public function delete($request);


}

























?>