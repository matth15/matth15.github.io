<?php

/**
 *  Auth Model
 */

class AuthModel extends Model{

  

    public function register($fullname, $email, $password, $grade_level ,$strand){
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('hashing/hash_cost_factor')));

        $this->db->beginTransaction();
        $query = "INSERT INTO students_data (name, email, password , grade_level ,strand) VALUES (:name, :email, :hashedPassword, :grade_level, :strand)";

         $this->db->prepare($query);
         $this->db->bindValue(':name', $fullname);
         $this->db->bindValue(':email', $email);
         $this->db->bindValue(':hashedPassword', $hashedPassword);
         $this->db->bindValue(':grade_level', $grade_level);
         $this->db->bindValue(':strand', $strand);
         $this->db->execute();
         $this->db->commit();

         return true;

    }

   
     // Signin Logic
     public function login($email,$password){ 
        // 1. get user from database
        $this->db->prepare("SELECT * FROM students_data WHERE email = :email LIMIT 1");
        $this->db->bindValue(':email', $email);
        $this->db->execute();
        $user =  $this->db->fetchAssociative();

        //2. Retrieve user data 
        $userId = isset($user["id"])? $user["id"]: null;
        $hashedPassword = isset($user["password"])? $user["password"]: null; 

       // 3. instantiate the validation class

        $rule = new ValidationRules(); 
        
        // 4. validate data returned from users table
        if(!$rule->credentials(["user_id" => $userId, "hashed_password" => $hashedPassword, "password" => $password])){
          
          session::set('danger', $email.' does not exist.'); 

          return false; 
       } 

       //5. Get Logged User session Values.
       Session::getUserSessions(["user_id" => $userId]);

       //6. If the validation succeeds, return the user data
       return true;
   }

   /**
    * 
    */
   function generateOTP($length = 6) {
    // Define the characters that can be used in the OTP
    $characters = '0123456789';
    $otp = '';

    // Generate random OTP
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $otp;
}


    public function updateGeneratedOTP($email, $otp, $otp_expiration) {
        $this->db->beginTransaction();
  
        $query = "UPDATE students_data SET otp = :otp, otp_expiration = :otp_expiration WHERE email = :email";
  
        $this->db->prepare($query);
        $this->db->bindValue(":otp", $otp);
        $this->db->bindValue(":otp_expiration", $otp_expiration);
        $this->db->bindValue(":email", $email);
        $this->db->execute();
        
        $this->db->commit();
        return true;
    }


    public function updateOTP($email) {
        $this->db->beginTransaction();
  
        $query = "UPDATE users SET otp = NULL, otp_expiration = NULL WHERE email = :email";
  
        $this->db->prepare($query);
        $this->db->bindValue(":email", $email);
        $this->db->execute();
        
        $this->db->commit();
        return true;
    }

   
    public function verifyOTP($email, $enteredOTP){
        // 1. Get the user's stored OTP from the database
        $this->db->prepare("SELECT * FROM students_data WHERE email = :email LIMIT 1");
        $this->db->bindValue(':email', $email);
        $this->db->execute();
        $user = $this->db->fetchAssociative();
    
        // 2. return stored OTP expiration 
         $otpExpiration = isset($user["otp_expiration"]) ? strtotime($user["otp_expiration"]) : null;
           

       // 3. Check OTP expiration
        if ($otpExpiration !== null && time() > $otpExpiration) {
            session::set('danger', 'OTP has expired. Please request a new OTP.'); 
            return false;
        }

         // 4. Compare the entered OTP with the stored OTP
         $storedOTP = isset($user["otp"]) ? $user["otp"] : null;    
        if ($enteredOTP === $storedOTP) {
            // OTP is correct, return true
            $this->updateOTP($email);
            return true;
        } 
    }


    public function getProfileInfo($userId){

        // 
        $this->db->getById("students_data", $userId);

        // Check if the user exists
        if($this->db->countRows() !== 1){
            // You may want to handle the case where the user doesn't exist
            return null;
        }

        return $user = $this->db->fetchAssociative();
      }
      
    //Logout Logic

    public function logout( $userId){
        Session::init();
        // Unset all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();
    }

}