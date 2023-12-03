<?php 

class AdminModel extends Model {


    
   


public function fetchAdminData($email){
    $this->db->prepare("SELECT * FROM admin WHERE email = :email");
    $this->db->bindValue(':email',$email);
    $this->db->execute();

    return $this->db->fetchAllAssociative();
}

}

?>