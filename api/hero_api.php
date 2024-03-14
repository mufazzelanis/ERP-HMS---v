<?php

function get_heros(){
    $heros=Hero::get_heros_json();
    echo $heros;
}

function get_hero($data){
  $hero=Hero::get_hero_json($data["id"]);
  echo $hero;
}

function delete_hero($data){
    Hero::delete($data["id"]);
    echo json_encode(["success"=>$data]);
}

function create_hero($data){
  $hero=new Hero(null,$data["name"]);
  $id=$hero->save();
  echo json_encode(["success"=>$data]);
}

function update_hero($data){
    $hero=new Hero($data["id"],$data["name"]);
    $hero->update();
    echo json_encode(["success"=>$data]);
}

//------Test New API ---------------

//Delete
function test_delete($data){
  echo json_encode(["success delete"=>$data]);
}

//Update
function test_put($data){
  echo json_encode(["success put"=>$data]);
}

//Save
function test_post($data){
  echo json_encode(["success post"=>$data]);
}

//Insert
function test_get($data){
  echo json_encode(["success get"=>$data]);
}

?>