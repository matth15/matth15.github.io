<?php

class StudentModel extends Model
{

    public function getStudentCount()
    {
        $this->db->prepare("SELECT COUNT(*) as count FROM students_data WHERE is_email_activated = 1");
        $this->db->execute();
        $result =  $this->db->fetchAssociative();
        $rowCount = $result['count'];
        return $rowCount;
    }

    public function fetchStudentDataPerPage($offset, $perPage)
    {
        $this->db->prepare("SELECT * FROM students_data WHERE is_email_activated = 1 LIMIT $offset,$perPage");
        $this->db->execute();

        return $this->db->fetchAllAssociative();
    }
}
