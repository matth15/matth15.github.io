<?php

/**=========================================================
 *               USER AUTHENTICATION MODEL
 * =========================================================
 */

class AuthModel extends Model
{
    // private $user_table = array("admin", "students_data", "teachers_data");

    //auth model register for students data to database
    /**
     * =============================================
     *           REGISTER STUDENTS MODEL
     * =============================================
     */
    public function register($fullname, $email, $password, $grade_level, $strand,$ParentPhoneNo)
    {

        $rule = new ValidationRules();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('hashing/hash_cost_factor')));
        // if (!$rule->unique($email, "email")) {
        //     Session::set("SIGNUP-ERROR", $email . " Email account already exist!");
        //     return false;
        // }

      try{
        $this->db->beginTransaction();
        $query = "INSERT INTO students_data (unique_id,name, email, parent_phone_no , password , grade_level ,strand,user_type) VALUES (:unique_id,:name, :email, :parent_phone_no, :hashedPassword, :grade_level, :strand,:user_type)";

        $unique_id = $this->generateStudentUniqueId();

        $this->db->prepare($query);
        $this->db->bindValue(':unique_id',$unique_id);
        $this->db->bindValue(':name', $fullname);
        $this->db->bindValue(':email', $email);
        $this->db->bindValue(':parent_phone_no', $ParentPhoneNo);
        $this->db->bindValue(':hashedPassword', $hashedPassword);
        $this->db->bindValue(':grade_level', $grade_level);
        $this->db->bindValue(':strand', $strand);
        $this->db->bindValue(':user_type', 'student');
        $this->db->execute();
        $this->db->commit();
      }
      catch(PDOException $e){
        return false;
      }
        return true;
    }

    /**
     * ====================================
     *        UPDATE USER DATA MODEL
     * ====================================
     * PROBLEM: none
     */


    /**
     * it return true if the update process for user data in specific table in execute bool
     * 
     * @param string $query 
     * @param array  $bindParam 
     * @param array  $table 
     * @param array  $bindValue
     *
     * @return bool  true|false
     */
    public function updateUserData($query, $table, $bindParam, $bindValue)
    {
        $newQuery = explode(" ? ", $query);
        //iterate 3x
        for ($i = 0; $i < count($table); $i++) {

            $esql = $newQuery[0] . ' ' . $table[$i] . ' ' . $newQuery[1];
            $this->db->prepare($esql);

            //iterate 3x
            for ($x = 0; $x < count($bindParam); $x++) {
                $this->db->bindValue($bindParam[$x], $bindValue[$x]);
            }
            if ($this->db->execute()) {
                return true;
            }
        }
        return false;
    }
    /**
     * ====================================
     *          GET USER DATA MODEL
     * ====================================
     * PROBLEM: none
     */
    public function fetchUserData($email)
    {
        $table = ["students_data", "teachers_data", "admin"];
        foreach ($table as $val) {
            $this->db->prepare("SELECT * FROM {$val} WHERE email = :email LIMIT 1");
            $this->db->bindValue(':email', $email);
            $this->db->execute();
            $user =  $this->db->fetchAssociative();
            if ($user) {
                return $user;
            }
        }
        return false;
    }

    /**
     * 
     * 
     * 
     * 
     */
    public function setUserVerified($email)
    {
        $table = ["students_data", "teachers_data", "admin"];
        $activator = 1;
        foreach ($table as $i) {
            $this->db->prepare("UPDATE {$i} SET is_email_activated = :activate WHERE email = :email LIMIT 1");
            $this->db->bindValue(':activate', $activator);
            $this->db->bindValue(':email', $email);
            if ($this->db->execute()) {
                return true;
            }
        }
        return false;
    }

    /**
     * ====================================
     *         LOGIN MODEL LOGIC
     * ====================================
     * PROBLEM: none
     */
    public function login($email, $password)
    {

        // 1. instantiate the validation class
        $rule = new ValidationRules();

        // check to the 3 table user if email exist and return user col table
        $user = $this->fetchUserData($email);

        //2. Retrieve user data 
        $userId = isset($user["id"]) ? $user["id"] : null;
        $user_type = isset($user['user_type']) ? $user['user_type'] : null;
        $hashedPassword = isset($user["password"]) ? $user["password"] : null;

        // 4. validate data returned from users table
        if (empty($user['email'])) {
            Session::set('LOGIN-ERROR', "Failed to log in. TRACE Email not found!");
            return false;
        }

        if (!$rule->credentials(["user_id" => $userId, "hashed_password" => $hashedPassword, "password" => $password])) {
            session::set('LOGIN-ERROR', 'Incorrect Password or TRACE E-mail address. Please try again.');
            return false;
        } 
        
        else {

            //5. Get Logged User session Values.
            Session::getUserSessions(["user_id" => $userId, "user_type" => $user_type, "user_email" => $email]);
            //6. If the validation succeeds, return the user data
            return true;
        }
    }
    /**
     * =========================================
     *           RESET PASSWORD MODEL
     * =========================================
     */
    public function reset_password($np, $email)
    {
        $newPassword = password_hash($np, PASSWORD_DEFAULT);
        $table = ["students_data","teachers_data","admin"];
        try {
            foreach($table as $val) {
            $sql = "UPDATE {$val} SET password = :password WHERE email = :email";
            $this->db->prepare($sql);
            $this->db->bindValue(':email', $email);
            $this->db->bindValue(':password', $newPassword);
            if ($this->db->execute()) {
                return true;
            }
        }
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
        return false;
    }
    /**
     * ========================================
     *          FORGOT PASSWORD MODEL 
     * ========================================
     */
    public function forgot_password($email)
    {
        $userData = $this->fetchUserData($email);

        $userEmail = isset($userData['email']) ? $userData['email'] : NULL;
        if (!empty($userEmail)) {
            Session::getUserSessions(["user_email" => $email]);
            return true;
        }
        return false;
    }

    /**
     * ====================================
     *            VERIFY OTP MODEL
     * ====================================
     * PROBLEM : none
     */
    public function verifyOTP($email, $enteredOTP)
    {
        // 1. Get the user's stored OTP from the database
        $user = $this->fetchUserData($email);

        // 2. return stored OTP expiration 
        $otpExpiration = isset($user["otp_expiration"]) ? strtotime($user["otp_expiration"]) : null;

        // 3. Check OTP expiration
        if ($otpExpiration !== null && time() > $otpExpiration) {
            session::set('OTP-ERROR', 'OTP has expired. Please request a new OTP.');
            return false;
        }
        // 4. Compare the entered OTP with the stored OTP
        $storedOTP = isset($user["otp"]) ? $user["otp"] : null;
        if ($enteredOTP == $storedOTP) {

            // OTP is correct, return true


            //login for login,forgot-password

            $this->updateOTP($email);
            return true;
        } else {
            Session::set('OTP-ERROR', "Invalid OTP Code!");
        }
    }


    
    public function generateStudentUniqueId(){
       try{
        $generatedId = $this->generateOTP(7);
        $this->db->prepare("SELECT * FROM students_data WHERE unique_id = :generatedId");
        $this->db->bindValue(":generatedId",$generatedId);
        $this->db->execute();
        $row = $this->db->fetchAssociative();
        if($row){
            $this->generateStudentUniqueId();
        }
        return $generatedId;
       }
       catch(PDOException $e){
       error_log( $e->getMessage());
        return false;
       }
       return false;
    }
    /**
     * ====================================
     *          GENERATED OTP MODEL
     * ====================================
     * PROBLEM: none
     */
    function generateOTP($length = 6)
    {
        // Define the characters that can be used in the OTP
        $characters = '0123456789';
        $otp = '';

        // Generate random OTP
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }

    /**
     * ====================================
     *      UPDATE GENERATED OTP MODEL
     * ====================================
     * PROBLEM : none
     */
    public function updateGeneratedOTP($email, $otp, $otp_expiration)
    {
        try {
            $this->db->beginTransaction();
            $table = ["students_data", "teachers_data", "admin"];
            foreach ($table as $t) {

                $this->db->prepare("UPDATE {$t} SET otp = :otp , otp_expiration = :otp_expiration WHERE email = :email");
                $this->db->bindValue(":otp", $otp);
                $this->db->bindValue(":otp_expiration", $otp_expiration);
                $this->db->bindValue(":email", $email);
                $this->db->execute();
            }
            $this->db->commit();
        } catch (PDOException $e) {
            var_dump(print_r($e->getMessage()));
            return false;
        }
        return true;
    }

    /**
     * ====================================
     *          UPDATE OTP MODEL
     * ====================================
     * PROBLEM: none
     */
    public function updateOTP($email)
    {
        $this->db->beginTransaction();

        $query = "UPDATE ? SET otp = NULL, otp_expiration = NULL WHERE email = :email";
        $bindParam = array(":email");
        $bindValue = array($email);
        $con = $this->updateUserData($query, ["students_data", "teachers_data", "admin"], $bindParam, $bindValue);
        $this->db->commit();
        return $con;
    }


    /**
     * ====================================
     *       GET PROFILE INFO MODEL       |
     * ====================================
     * PROBLEM : none
     */
    public function getProfileInfo($email)
    {
        $table = ["students_data", "teachers_data", "admin"];
        // 
        for ($i = 0; $i < count($table); $i++) {
            $this->db->getByUserEmail($table[$i], $email);
            // Check if the user exists
            if ($this->db->countRows() > 0) {
                return $user = $this->db->fetchAssociative();
            }
        }

        // You may want to handle the case where the user doesn't exist
        return null;
    }

    /**
     * ====================================
     *       LOGOUT SESSION ACCOUNT       
     * ====================================
     *  PROBLEM : none
     *  
     */
    public function logout($userId)
    {
        Session::init();
        // Unset all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();
    }
}
