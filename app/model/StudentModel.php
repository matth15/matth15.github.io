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
        $this->db->prepare("SELECT * FROM students_data ORDER BY strand ASC LIMIT $offset,$perPage");
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
    public function updateStudentData($name,$email,$strand,$section,$grade,$class,$id){
        $sql = "UPDATE students_data SET name = :name , email = :email , strand = :strand , section = :section , grade_level = :grade , strand_class = :class WHERE id = :id ";
        $this->db->prepare($sql);
        $this->db->bindValue(":id",$id);
        $this->db->bindValue(":name",$name);
        $this->db->bindValue(":email",$email);
        $this->db->bindValue(":strand",$strand);
        $this->db->bindValue(":grade",$grade);
        $this->db->bindValue(":section",$section);
        $this->db->bindValue(":class",$class);
        if($this->db->execute()){
            return true;
        }
        return false;
    }

    public function deleteStudent($studentId){
        $sql = "DELETE FROM students_data WHERE id = :id";
        $this->db->prepare($sql);
        $this->db->bindValue(":id",$studentId);
        if($this->db->execute()){
            return true;
        }
        return false;
    }

    public function searchStudent($search){
        $sql = "SELECT * FROM students_data WHERE name LIKE '$search%' OR email LIKE '$search%'";
        $this->db->prepare($sql);
        if($this->db->execute()){
            $res = $this->db->fetchAssociative();
            if( $res > 1){
                return $res;
            }
        }
        return false;
    }
}
