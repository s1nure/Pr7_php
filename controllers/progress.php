<?php
include 'modules/progress.php';
class ProgressController{
    public $model;

    public function __construct(){
        $this->model = new ProgressModel;
    }

    public function redirect($url){
        if($url) header('Location: '.$url);
    }

    public function index(){ 
        include 'views/progress.php';
    }
    public function getData() {
        $data['progress'] = $this->model->getProgressFromDB();
        $data['students'] = $this->model->getStudents();
        $data['subjects'] = $this->model->getSubjects();  
         die(json_encode($data));
    }

    public function addProgress(){
        if($_POST['mark']){
            $this->model->addProgressToDB();
            die(json_encode(true));
        }
    }
    public function actions(){
      if($_POST['delete']) $this->model->deleteProgressFromDB();
      if($_POST['update']) $this->model->updateProgress();

            die(json_encode(true));
    }
}

?>