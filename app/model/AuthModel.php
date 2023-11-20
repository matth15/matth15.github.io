<?php

/**=========================================================
 *               USER AUTHENTICATION MODEL
 * =========================================================
 */

class AuthModel extends Model
{
    private $user_table = array("students_data", "teachers_data", "admin");

    //auth model register for students data to database
    public function register($fullname, $email, $password, $grade_level, $strand)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('hashing/hash_cost_factor')));

        $this->db->beginTransaction();
        $query = "INSERT INTO students_data (name, email, password , grade_level ,strand,user_type) VALUES (:name, :email, :hashedPassword, :grade_level, :strand,:user_type)";

        $this->db->prepare($query);
        $this->db->bindValue(':name', $fullname);
        $this->db->bindValue(':email', $email);
        $this->db->bindValue(':hashedPassword', $hashedPassword);
        $this->db->bindValue(':grade_level', $grade_level);
        $this->db->bindValue(':strand', $strand);
        $this->db->bindValue(':user_type', 'student');
        $this->db->execute();
        $this->db->commit();

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
      * @param array  $table 
      * @param array  $bindParam 
      * @param array  $bindValue
      *
      * @return bool  true|false
      */
    public function updateUserData($query, $table, $bindParam, $bindValue)
    {
        $newQuery = explode(" ? ", $query);

        for ($i = 0; $i < count($table); $i++) {
            $esql = $newQuery[0] . ' ' . $table[$i] . ' ' . $newQuery[1];
            $this->db->prepare($esql);
            for ($x = 0; $x < count($table); $x++) {
                $this->db->bindValue($bindParam[$x], $bindValue[$x]);
            }
            if ($this->db->execute()) {
                return true;
                break;
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
    public function getUserData($table, $email)
    {
        foreach ($table as $val) {
            $this->db->prepare("SELECT * FROM {$val} WHERE email = :email LIMIT 1");
            $this->db->bindValue(':email', $email);
            $this->db->execute();
            $user =  $this->db->fetchAssociative();
            if ($user) {
                return $user;
                break;
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
        $user = $this->getUserData(array("students_data", "teachers_data", "admin"), $email);

        //2. Retrieve user data 
        $userId = isset($user["id"]) ? $user["id"] : null;
        $user_type = isset($user['user_type']) ? $user['user_type'] : null;
        $hashedPassword = isset($user["password"]) ? $user["password"] : null;

        // 4. validate data returned from users table
        if (!$rule->credentials(["user_id" => $userId, "hashed_password" => $hashedPassword, "password" => $password])) {
            session::set('danger', $email . ' email account does not exist.');
            return false;
        } else {
            //5. Get Logged User session Values.
            // Session::getUserSessions(["user_id" => $userId, "user_type" => $user_type]);

            //6. If the validation succeeds, return the user data
            return true;
        }
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
        $user = $this->getUserData(array("students_data", "teachers_data", "admin"), $email);

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
        $this->db->beginTransaction();


        $query = "UPDATE ? SET otp = :otp, otp_expiration = :otp_expiration WHERE email = :email";
        $bindParam = array(":otp", ":otp_expiration", ":email");
        $bindValue = array($otp, $otp_expiration, $email);
        $con = $this->updateUserData($query, $this->user_table, $bindParam, $bindValue);
        $this->db->commit();
        return $con;
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
        $con = $this->updateUserData($query, $this->user_table, $bindParam, $bindValue);
        $this->db->commit();
        return $con;
    }


    /**
     * ====================================
     *       GET PROFILE INFO MODEL       |
     * ====================================
     * PROBLEM : none
     */
    public function getProfileInfo($userId)
    {

        // 
        $this->db->getById("students_data", $userId);

        // Check if the user exists
        if ($this->db->countRows() !== 1) {
            // You may want to handle the case where the user doesn't exist
            return null;
        }

        return $user = $this->db->fetchAssociative();
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
