<?php

require_once 'BaseModel.php';

/**
 * Description of User
 *
 * @author dmitri
 */
class User extends BaseModel
{
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;
    protected $password_repeat;
    protected $password_hash;
    protected $registration_confirm_token;
    protected $table_name = 'user';    
    protected $dbFields = ['first_name', 'last_name', 'email', 'password_hash', 'registration_confirm_token'];
    
    public function getFirstName()
    {
        return $this->first_name;
    }
    
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }
    
    public function getLastName()
    {
        return $this->last_name;
    }
    
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }    

    public function getEmail()
    {
        return $this->email;
    }    
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;        
    }    
    
    private function setPasswordHash($hash)
    {
        $this->password_hash = $hash;
    }
    
    public function getPasswordHash()
    {
        return $this->password_hash;
    }
    
    public function setPassword($password)
    {
        $this->setPasswordHash(md5($password));
        $this->password = $password;
                
        return $this;
    }
    
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->password_repeat = $passwordRepeat;
        return $this;
    }
    
    public function generateRegistrationConfirmToken()
    {
        $token = md5($this->email) . md5(microtime());
        $this->registration_confirm_token = $token;
    }            
    
    public function getRegistrationConfirmToken()
    {
        return $this->registration_confirm_token;
    }
    
    public function validate()
    {
        $errors = [];
        
        if($this->password != $this->password_repeat) {
            $errors[] = 'Repeat your password correctly';
        }
        
        if(!preg_match("/^[-a-z0-9.]+@[-a-z0-9.]+\.[-a-z0-9.]+$/i", $this->email)) 
        {
            $errors[]= 'Email is incorrect';
        }
        
        return $errors;
    }
    
}
