<?php

include_once (ROOT.'/models/UserModel.php');


class IndexController {
    
    
    public function actionIndex(){
        include (ROOT.'/views/IndexView.php');
        return TRUE;
    }
    
    
    public function actionStart(){
        $user_id = UserModel::checkLogged();
        if($user_id){
            echo '1';
        }else{
            echo '';
        }
        return TRUE;
    }
    
    
    public function actionTemplate($tpl_name){
        include (ROOT.'/views/'.$tpl_name.'View.php');
        return TRUE;
    }
    
}