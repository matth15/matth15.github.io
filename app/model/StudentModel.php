<?php

class StudentModel extends Model
{

    public function getStudentCount()
    {
        $this->db->prepare("SELECT COUNT(*) as count FROM students_data ");
        $this->db->execute();
        $result =  $this->db->fetchAssociative();
        $rowCount = $result['count'];
        return $rowCount;
    }

    public function fetchStudentDataPerPage($offset, $perPage)
    {
        $this->db->prepare("SELECT * FROM students_data  LIMIT $offset,$perPage");
        $this->db->execute();

        return $this->db->fetchAllAssociative();
    }
    public function fetchStudentProfile($studentId){
        $this->db->prepare("SELECT * FROM students_data WHERE id = {$studentId} ");
        $this->db->execute();
        $res = $this->db->fetchAssociative();
        if($res > 1){
            return $res;   
        }
        return false;
    }
}
