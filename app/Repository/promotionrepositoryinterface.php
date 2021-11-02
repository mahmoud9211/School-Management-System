<?php

namespace App\Repository;


interface promotionrepositoryinterface {

    public function create();

    public function store ($request);

    public function index ();

    public function destroy($request);
    
    public function delete($id);


}