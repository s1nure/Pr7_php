<?php 
class ProgressModel extends Model{

    public function getProgressFromDB(){
        $q = "SELECT * FROM progress";
        return $this->db_select_array($q);
    }
    public function getStudents(){
      $q = "SELECT * FROM students";
        return $this->db_select_array($q);
    } 
    
     public function getSubjects(){
        $q = "SELECT * FROM subjects";
        return $this->db_select_array($q);
    }

    public function addProgressToDB(){
        $q = $this->insert_db_query($_POST, 'progress');
        $this->db_query($q);
    }

    public function deleteProgressFromDB(){
      $q = "DELETE FROM progress WHERE id = ".$_POST['delete'];
      $this->db_query($q);
    } 

    public function updateProgress(){
        $q = "UPDATE progress SET mark='".$_POST['mark']."', student_id='".$_POST['student_id']."', subject_id='".$_POST['subject_id']."' WHERE id= ".$_POST['update'];
        $this->db_query($q);
    } 
}

?>