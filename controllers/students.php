<?php
include 'modules/students.php';
class StudentsController{
    public $model;

    public function __construct(){
        $this->model = new StudentsModel;
    }

    public function redirect($url){
        if($url) header('Location: '.$url);
    }

    public function index(){
        $students = $this->model->getStudentsFromDB();
        $groups = $this->model->getGroupFromDB();

        include 'views/default.php';
    }

    public function addStudent(){
        if($_POST['name'] && $_POST['group_id']){
            $this->model->addStudentToDB();
            $this->redirect('/Pr8/');
        }
    }
    public function actions(){
      if($_POST['delete']) $this->model->deleteStudentFromDB();
      if($_POST['update']) $this->model->updateStudent();

      $this->redirect('/Pr8/');
    }
}

?>