<?php 

class AdminModel extends Model {


public function fetchStudentData(){
    $this->db->prepare("SELECT * FROM students_data WHERE is_email_activated = 1");
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}
public function fetchFacultyData(){
    $this->db->prepare("SELECT * FROM teachers_data WHERE is_email_activated = 1");
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}

public function getStudentCount(){
    $this->db->prepare("SELECT COUNT(*) as count FROM students_data WHERE is_email_activated = 1");
    $this->db->execute();
    $result =  $this->db->fetchAssociative();
    $rowCount = $result['count'];
    return $rowCount;
}
public function getFacultyCount(){
    $this->db->prepare("SELECT COUNT(*) as count FROM teachers_data WHERE is_email_activated = 1");
    $this->db->execute();
    $result =  $this->db->fetchAssociative();
    $rowCount = $result['count'];
    return $rowCount;
}
}

?>