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
        $progress = $this->model->getProgressFromDB();
        $students = $this->model->getStudents();
        $subjects = $this->model->getSubjects();  
        include 'views/progress.php';
    }

    public function addProgress(){
        if($_POST['mark']){
            $this->model->addProgressToDB();
            $this->redirect('/Pr8/index.php/progress');
        }
    }
    public function actions(){
      if($_POST['delete']) $this->model->deleteProgressFromDB();
      if($_POST['update']) $this->model->updateProgress();

     $this->redirect('/Pr8/index.php/progress');
    }
}

?>