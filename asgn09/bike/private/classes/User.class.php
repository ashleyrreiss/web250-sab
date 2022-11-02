<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'username', 'hashed_password', 'user_level'];

  public $id;
  public $first_name;
  public $last_name;
  public $email;
  public $username;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;
  public $user_level;

  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
    $this->user_level = $args['user_level'] ?? '';
  }

  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

  /**
   * Encrypts the user's password
   *
   * @return  [string]  The hashed password
   */
  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  /**
   * Creates the hashed password before creating the rest of the
   * object. Overriding parent::create() then calling it after setting
   * hashed password. parent::create() is in DatabaseObject.class.php
   *
   * @return  [string/boolean]  success (SQL string) or not success (false)
   */

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  /**
   * Creates the hashed password before updating the rest of the
   * object. Overriding parent::update() then calling it after setting
   * hashed password. parent::update() is in DatabaseObject.class.php
   *
   * @return  [string/boolean]  success (SQL string) or not success (false)
   */

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      //validate
    } else {
      //password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  /**
   * Validates that the user input from users/form_fields
   * meets all requirements
   *
   * @return  [array]  Returns array of errors if there are any
   * errors. Otherwise it returns nothing.
   */
  protected function validate() {
    $this->errors = [];
  
    if(is_blank($this->first_name)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->last_name)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }
  
    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }
  
    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "Username must be between 8 and 255 characters.";
    }
    
    if($this->password_required) {

      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }
  
      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }
  
    return $this->errors;
  }

}

?>
