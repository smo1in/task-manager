<?php

include_once ROOT.'/models/UserModel.php';
include_once ROOT.'/models/TasksModel.php';

class TasksController {
    
    private $user_id;
    private $answer;
    
    public function __construct() {
        $this->user_id = UserModel::checkLogged();
        if(!$this->user_id){
            echo 'false';
            exit();
        }
        $this->answer = array(
            'ok' => 0,
            'msg' => array(),
            'data' => array()
        );
    }

    public function actionIndex(){
        if(isset($_POST['proj_id'])){
            $proj_id = intval($_POST['proj_id']);
            $this->answer['data'] = TasksModel::getAllByProjId($proj_id);
            if($this->answer['data'] !== FALSE){
                $this->answer['ok'] = 1;
            }else{
                $this->answer['msg'][] = 'error connection to database';
            }
        }  else {
            $this->answer['msg'][] = "project id wasn't gotten";
        }
        echo (json_encode($this->answer));
        return TRUE;
    }
   
    public function actionCreate(){
        $name = '';
        $priority = time();
        $proj_id = NULL;
        
        if(isset($_POST['name'])){
            $name = htmlentities($_POST['name'], ENT_QUOTES);
        }
        if($name === ''){
            $this->answer['msg'][] = 'please, enter value for task';
        }
        if(isset($_POST['proj_id'])){
            $proj_id = intval($_POST['proj_id']);
        }  else {
            $this->answer['msg'][] = "project id wasn't gotten";
        }
        
        if(!$this->answer['msg']){
            if(TasksModel::create($name, $priority, $proj_id)){
                $this->answer['data'] = TasksModel::getLastByProjId($proj_id);
                if($this->answer['data']){
                    $this->answer['ok'] = 1;
                    $this->answer['msg'][] = "task was created";
                }else{
                    $this->answer['msg'][] = "task was created, but data wasn't get";
                }
            }else{
                $this->answer['msg'][] = "task wasn't created";
            }
        }
        
        echo (json_encode($this->answer));
        return TRUE;
    }
    
    
    public function actionUpdate(){
        $name = '';
        $id = NULL;
        
        if(isset($_POST['name'])){
            $name = htmlentities($_POST['name'], ENT_QUOTES);
        }
        if($name === ''){
            $this->answer['msg'] = 'please, enter name for task';
        }
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
        }
        
        if(!$this->answer['msg'] && $id){
            if(TasksModel::updateById($id, $name)){
                $this->answer['data'] = TasksModel::getById($id);
                if($this->answer['data']){
                    $this->answer['ok'] = 1;
                    $this->answer['msg'] = "task was updated";
                }else{
                    $this->answer['msg'] = "task was updated, but data wasn't get";
                }
            }else{
                $this->answer['msg'] = "task wasn't updated";
            }
        }
        
        echo (json_encode($this->answer));
        return TRUE;
    }
   
    public function actionDelete(){
        $id = NULL;
        
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
        }
        
        if($id){
            $task = TasksModel::getById($id);
            if(TasksModel::deleteById($id)){
                $this->answer['ok'] = 1;
                $this->answer['data'] = $task;
                $this->answer['msg'][] = "task was deleted";
            }else{
                $this->answer['msg'][] = "task wasn't deleted";
            }
        }
        
        echo (json_encode($this->answer));
        return TRUE;
    }
    

    public function actionSetDeadline(){
        $id = NULL;
        $deadline = NULL;
        
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
        }
        if(isset($_POST['deadline'])){
            $deadline = $_POST['deadline'];
        }
        if(!$deadline){
            $deadline = NULL;
        }
        
        if($id){
            if(TasksModel::setDeadline($id, $deadline)){
                $this->answer['ok'] = 1;
                $this->answer['data'] = TasksModel::getById($id);
                $this->answer['msg'][] = "deadline was changed";
            }else{
                $this->answer['msg'][] = "deadline wasn't changed";
            }
        }
        echo (json_encode($this->answer));
        return TRUE;
    }
    
  
    public function actionExchangePriority(){
        $id_1 = NULL;
        $id_2 = NULL;
        
        if(isset($_POST['id_1'])){
            $id_1 = intval($_POST['id_1']);
        }
        if(isset($_POST['id_2'])){
            $id_2 = intval($_POST['id_2']);
        }
        
        if($id_1 && $id_2){
            if(TasksModel::exchangePriority($id_1, $id_2)){
                $this->answer['ok'] = 1;
                $this->answer['data']['task_1'] = TasksModel::getById($id_1);
                $this->answer['data']['task_2'] = TasksModel::getById($id_2);
                $this->answer['msg'][] = "priority was changed";
            }else{
                $this->answer['msg'][] = "priority wasn't changed";
            }
        }
        echo (json_encode($this->answer));
        return TRUE;
    }
    
  
    public function actionChangeStatus(){
        $id = NULL;
        $status = 0;
        
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
        }
        if(isset($_POST['status'])){
            $status = intval($_POST['status']);
        }
        
        if($id){
            if(TasksModel::changeStatus($id, $status)){
                $this->answer['ok'] = 1;
                $this->answer['data'] = TasksModel::getById($id);
                $this->answer['msg'][] = "status was changed";
            }else{
                $this->answer['msg'][] = "status wasn't changed";
            }
        }
        echo (json_encode($this->answer));
        return TRUE;
    }
}
