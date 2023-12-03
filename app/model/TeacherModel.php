<?php 
class TeacherModel extends Model {

    public function getFacultyCount(){
        $this->db->prepare("SELECT COUNT(*) as count FROM teachers_data WHERE is_email_activated = 1");
        $this->db->execute();
        $result =  $this->db->fetchAssociative();
        $rowCount = $result['count'];
        return $rowCount;
    
}

public function fetchFacultyData(){
    $this->db->prepare("SELECT * FROM teachers_data WHERE is_email_activated = 1");
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}
}
?>