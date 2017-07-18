<!--
TITLE: Lab 3
AUTHOR: Carlos Huizar
File Name: customer.php
ORIGINALLY CREATED ON: 07/16/2017
-->

<?php

/**
 * Customer Class
 */
class Customer {
    private $fName;
    private $lName;
    private $email;
    private $emailConfirm;
    private $password;
    private $passwordConfirm;
    private $department;

    function __construct() {
        $this->fName = "";
        $this->lName = "";
        $this->email = "";
        $this->emailConfirm = "";
        $this->password = "";
        $this->passwordConfirm = "";
        $this->department = "";
    }

    public function setFName($fName) {
        $this->fName = $fName;
    }

    public function getFName() {
        return $this->fName;
    }

    public function setLName($lName) {
        $this->lName = $lName;
    }

    public function getLName() {
        return $this->lName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmailConfirm($emailConfirm) {
        $this->emailConfirm = $emailConfirm;
    }

    public function getEmailConfirm() {
        return $this->emailConfirm;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPasswordConfirm($passwordConfirm) {
        $this->passwordConfirm = $passwordConfirm;
    }

    public function getPasswordConfirm() {
        return $this->passwordConfirm;
    }

    public function setDepartment($department) {
        $this->department = $department;
    }

    public function getDepartment() {
        return $this->department;
    }
}

 ?>
