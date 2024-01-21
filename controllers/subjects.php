<?php
include 'modules/subjects.php';
class SubjectsController{
    public $model;

    public function __construct(){
        $this->model = new SubjectsModel;
    }

    public function redirect($url){
        if($url) header('Location: '.$url);
    }

    public function index(){
        $subjects = $this->model->getSubjectsFromDB();
        include 'views/subjects.php';
    }

    public function addSubject(){
        if($_POST['name']){
            $this->model->addSubjectsToDB();
            $this->redirect('/Pr8/index.php/subjects');
        }
    }
    public function actions(){
      if($_POST['delete']) $this->model->deleteSubjectsFromDB();
      if($_POST['update']) $this->model->updateSubjects();

     $this->redirect('/Pr8/index.php/subjects');
    }
}

?>