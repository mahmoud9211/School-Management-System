<?php

namespace App\Repository;


interface feesrepositoryinterface {


public function study_fees_index();

public function create_fees_page();

public function study_fees_store($request);

public function study_fees_edit($id);

public function study_fees_update($id,$request);

public function fees_study_delete($id);
















}