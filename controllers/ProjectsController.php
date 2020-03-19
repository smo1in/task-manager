<?php

include_once ROOT.'/models/UserModel.php';
include_once ROOT.'/models/ProjectsModel.php';


class ProjectsController {
    
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
        $this->answer['data'] = ProjectsModel::getAllByUserId($this->user_id);
        if($this->answer['data'] !== FALSE){
            $this->answer['ok'] = 1;
        }else{
            $this->answer['msg'][] = 'error connection to database';
        }
        
        echo (json_encode($this->answer));
        return TRUE;
    }
   
    public function actionCreate(){
        $name = '';
       
        if(isset($_POST['name'])){
            $name = htmlentities($_POST['name'], ENT_QUOTES);
        }
        if($name === ''){
            $this->answer['msg'][] = 'please, enter name for TODO list';
        }
        
        if(!$this->answer['msg']){
            if(ProjectsModel::create($name, $this->user_id)){
                $this->answer['data'] = ProjectsModel::getLastByUserId($this->user_id);
                if($this->answer['data']){
                    $this->answer['ok'] = 1;
                    $this->answer['msg'][] = "TODO list was created";
                }else{
                    $this->answer['msg'][] = "TODO list was created, but data wasn't get";
                }
            }else{
                $this->answer['msg'][] = "TODO list wasn't created";
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
            $this->answer['msg'][] = 'please, enter name for TODO list';
        }
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
        }
        
        if(!$this->answer['msg'] && $id){
            if(ProjectsModel::updateById($id, $name)){
                $this->answer['data'] = ProjectsModel::getById($id);
                if($this->answer['data']){
                    $this->answer['ok'] = 1;
                    $this->answer['msg'][] = "TODO list was updated";
                }else{
                    $this->answer['msg'][] = "TODO list was updated, but data wasn't get";
                }
            }else{
                $this->answer['msg'][] = "TODO list wasn't updated";
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
            if(ProjectsModel::deleteById($id)){
                $this->answer['ok'] = 1;
                $this->answer['msg'][] = "TODO list was deleted";
                $this->answer['data']['id'] = $id;
            }else{
                $this->answer['msg'][] = "TODO list wasn't deleted";
            }
        }
        
        echo (json_encode($this->answer));
        return TRUE;
    }
    
}
