<?php
    class FormValidation
    {
        public $valid = true;

        private $_errorFields = [];
        
        public function checkEmpty($fieldName) {
            $message = "";

            if (!isset($_POST[$fieldName]) || empty($_POST[$fieldName])) {
                $this -> _errorFields[] = $fieldName;
                $this -> valid = false;
                $message = "Please supply a value";
            }

            return $message;
        }

        public function checkEmail($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName])) {
                if (!filter_var($_POST[$fieldName], FILTER_VALIDATE_EMAIL)) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Please enter a valid email";
                }
            }

            return $message;
        }

        public function checkContactNumber($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed";
                }
            }

            return $message;
        }

        public function checkName($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^[a-zA-Z \-']*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only letters, apostrophes, hyphens and white space are allowed";
                }
            }

            return $message;
        }

        public function checkState($fieldName, $isRequired) {
            $message = "";
            $allowedStates = ["NSW", "ACT", "VIC", "QLD", "NT", "SA", "WA", "TAS"];

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!in_array($_POST[$fieldName], $allowedStates)) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Please select a state";
                }
            }

            return $message;
        }

        public function checkPostcode($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed";
                } else if (!preg_match("/[0-9]{4}$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Must have 4 digits";
                }
            }

            return $message;
        }

        public function checkCardNumber($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed (do not include spaces or dashes)";
                }
            }

            return $message;
        }

        public function checkExpirationMonth($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed";
                } else if (!preg_match("/[0-9]{2}$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = 'Must have 2 digits. Numbers below 10 must have a leading zero (e.g "02")';
                } else if (!preg_match("/^(0[1-9]|1[0-2])$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = 'Invalid month, must be between 01 and 12';
                }
            }

            return $message;
        }

        public function checkExpirationYear($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed";
                } else if (!preg_match("/[0-9]{2}$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = 'Must have 2 digits';
                }
            }

            return $message;
        }

        public function checkCVC($fieldName, $isRequired) {
            $message = "";

            if ($isRequired) {
                if (!$this->checkEmpty($fieldName) == "") {
                    $message = $this->checkEmpty($fieldName);
                    return $message;
                }
            }

            if (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                if (!preg_match("/^\d*$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Only digits are allowed";
                } else if (!preg_match("/[0-9]{3}$/", $_POST[$fieldName])) {
                    $this -> _errorFields[] = $fieldName;
                    $this -> valid = false;
                    $message = "Must have 3 digits";
                } 
            }

            return $message;
        }

        public function checkPassword($fieldName, $accusername) {
            $message = "";
            $hash = "";

            include "settings/db.php";

            try {
                $db = new DBAccess($dsn, $username, $password);
            } catch (PDOException $e) {
                die("Unable to connect to database, " . $e->getMessage());
            }

            try {
                $pdo = $db->connect();
                $sql = "SELECT password FROM user WHERE username=:username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":username", $accusername, PDO::PARAM_STR);
                $hash = $db->executeSQLReturnOneValue($stmt);
            } catch (PDOException $e) {
                throw $e;
            }

            if (!password_verify($_POST[$fieldName], $hash)) {
                $this -> _errorFields[] = $fieldName;
                $this -> valid = false;
                $message = "Password incorrect";
            }

            return $message;
        }

        public function checkPasswordEquality($fieldName, $secondFieldName) {
            $message = "";

            if ($_POST[$fieldName] != $_POST[$secondFieldName]) {
                $this -> _errorFields[] = $fieldName;
                $this -> _errorFields[] = $secondFieldName;
                $this -> valid = false;
                $message = "Passwords do not match";
            }

            return $message;
        }

        public function setErrorClass($fieldName) {
            if (in_array($fieldName, $this -> _errorFields)) {
                return 'class="is-invalid"';
            }
        }

        public function setValue($fieldName) {
            if (isset($_POST[$fieldName])) {
                return htmlentities($_POST[$fieldName]);
            }
        }

        public function setSelected($fieldName, $fieldValue) {
            if (isset($_POST[$fieldName]) && $_POST[$fieldName] == $fieldValue) {
                return "selected";
            }
        }

        public function setChecked($fieldName, $fieldValue) {
            if (isset($_POST[$fieldName]) && $_POST[$fieldName] == $fieldValue) {
                return "checked";
            }
        }

    }

?>