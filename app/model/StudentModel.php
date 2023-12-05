<?php

class StudentModel extends Model
{

    //
    public function getStudentCount()
    {
        $this->db->prepare("SELECT COUNT(*) as count FROM students_data ");
        $this->db->execute();
        $result =  $this->db->fetchAssociative();
        $rowCount = $result['count'];
        return $rowCount;
    }
    //
    public function fetchStudentDataPerPage($offset, $perPage)
    {
        $this->db->prepare("SELECT * FROM students_data  LIMIT $offset,$perPage");
        $this->db->execute();

        return $this->db->fetchAllAssociative();
    }
    //
    public function fetchStudentProfile($studentId){
        $this->db->prepare("SELECT * FROM students_data WHERE id = {$studentId} ");
        $this->db->execute();
        $res = $this->db->fetchAssociative();
        if($res > 1){
            return $res;   
        }
        return false;
    }
    //
    public function updateStudentData($name,$email,$strand,$grade,$class,$id){
        $sql = "UPDATE students_data SET name = :name, email = :email, strand = :strand, grade_level = :grade, class = :class WHERE id = :id ";
        $this->db->prepare($sql);
        $this->db->bindValue(":id",$id);
        $this->db->bindValue(":name",$name);
        $this->db->bindValue(":email",$email);
        $this->db->bindValue(":strand",$strand);
        $this->db->bindValue(":grade",$grade);
        $this->db->bindValue(":class",$class);
        if($this->db->execute()){
            return true;
        }
        return false;
    }
}
