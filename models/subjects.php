<?php 
class SubjectsModel extends Model{

    public function getSubjectsFromDB(){
        $q = "SELECT * FROM subjects";
        return $this->db_select_array($q);
    }

    public function addSubjectsToDB(){
        $q = $this->insert_db_query($_POST, 'subjects');
        $this->db_query($q);
    }
    public function deleteSubjectsFromDB(){
      $q = "DELETE FROM subjects WHERE id = ".$_POST['delete'];
      $this->db_query($q);
    } 

    public function updateSubjects(){
        $q = "UPDATE subjects SET name='".$_POST['name'][$_POST['update']]."' WHERE id= ".$_POST['update'];
        $this->db_query($q);
    } 
}

?>