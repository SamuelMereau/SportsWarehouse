<?php
    require_once "DBAccess.php";
    /**
     * Allows information to be retrieved from product categories
     * 
     * @author Samuel Mereau
     */
    class Category 
    {
        private int $_categoryId;
        private string $_categoryName;
        private object $_db;

        public function __construct()
        {
            include "settings/db.php";

            try 
            {
                $this->_db = new DBAccess($dsn, $username, $password);
            } 
            catch (PDOException $e) 
            {
                die("Unable to connect to database, " . $e->getMessage());
            }
        }

        public function getCategoryID()
        {
            return $this->_categoryId;
        }

        public function getCategoryName()
        {
            return $this->_categoryName;
        }

        public function getNextCategoryId() 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'category';";
                $stmt = $pdo->prepare($sql);

                $row = $this->_db->executeSQLReturnOneValue($stmt);
                
                if ($stmt->rowCount() == 0) {
                    return -1;
                }

                return $row;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function addCategory(string $categoryName)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "INSERT INTO category(`categoryName`) VALUES (:categoryName)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);

                $row = $this->_db->executeNonQuery($stmt);
                
                if ($stmt->rowCount() == 0) {
                    return -1;
                }

                return $row;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function setCategoryName(string $categoryName, int $categoryId) 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE category SET categoryName=:categoryName WHERE categoryId=:categoryId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_categoryName = $categoryName;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getCategory(int $id)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "SELECT * FROM category WHERE categoryId = :categoryId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryId', $id, PDO::PARAM_INT);

                $rows = $this->_db->executeSQL($stmt);
                
                if ($stmt->rowCount() == 0) {
                    return -1;
                }

                // Get the first row as it is a primary key there will only be one row
                $row = $rows[0];

                $this->_categoryId = $row["categoryId"];
                $this->_categoryName = $row["categoryName"];

                return $this->_categoryId;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getCategories()
        {
            try 
            {
                $pdo = $this->_db->connect();

                $sql = "SELECT * FROM category";
                $stmt = $pdo->prepare($sql);

                $rows = $this->_db->executeSQL($stmt);

                return $rows;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getNumberOfCategories()
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "SELECT count(*) FROM category";
                $stmt = $pdo->prepare($sql);

                $value = $this->_db->executeSQLReturnOneValue($stmt);
                
                return $value;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }
        
        public function getItemsInCategory(int $categoryId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "SELECT * FROM item WHERE categoryId = :categoryId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

                $rows = $this->_db->executeSQL($stmt);
                
                if ($stmt->rowCount() == 0) {
                    return [];
                }
                
                return $rows;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function deleteCategory(int $categoryId) 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "DELETE FROM category WHERE categoryId = :categoryId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

                $this->_db->executeSQL($stmt);

                return 1;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }
    }
?>