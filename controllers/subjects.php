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
        include 'views/index.php';
    }
    public function getData() {
        $data['subjects'] = $this->model->getSubjectsFromDB();
         die(json_encode($data));
    }
    public function addSubject(){
        if($_POST['name']){
            $this->model->addSubjectsToDB();
            die(json_encode(true));
        }
    }
    public function actions(){
      if($_POST['delete']) $this->model->deleteSubjectsFromDB();
      if($_POST['update']) $this->model->updateSubjects();

            die(json_encode(true));
    }
}

?>