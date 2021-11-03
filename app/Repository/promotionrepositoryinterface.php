<?php

namespace App\Repository;


interface promotionrepositoryinterface {

    public function create();

    public function store ($request);

    public function index ();

    public function destroy($request);
    
    public function delete($id);

    public function Add_graduation_page();

    public function store_graduation($request);

    public function graduation_index();

    public function graduation_update($request);

    public function delete_graduated($request);


}