<?php 

class AdminModel extends Model {


public function fetchStudentData(){
    $this->db->prepare("SELECT * FROM students_data");
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}
public function fetchFacultyData(){
    $this->db->prepare("SELECT * FROM teachers_data");
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}

public function getStudentCount(){
   return $this->db->countAll("students_data");
}
public function getFacultyCount(){
    return $this->db->countAll("teachers_data");
}
}

?>