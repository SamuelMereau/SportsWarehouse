<?php
    require_once "DBAccess.php";
    /**
     * Allows information to be retrieved from product items
     * 
     * @author Samuel Mereau
     */
    class Item 
    {
        private int $_itemId;
        private string $_itemName;
        private string $_photo;
        private $_price;
        private $_salePrice;
        private string $_description;
        private bool $_featured;
        private int $_categoryId;

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

        public function addItem(
            string $itemName,
            string $photo,
            $price,
            $salePrice,
            string $description,
            bool $featured,
            int $categoryId
        )
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "INSERT INTO item(itemName, photo, price, salePrice, description, featured, categoryId) VALUES (:itemName, :photo, :price, :salePrice, :description, :featured, :categoryId)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
                $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
                $stmt->bindParam(':price', $price, PDO::PARAM_STR);
                $stmt->bindParam(':salePrice', $salePrice, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':featured', $featured, PDO::PARAM_BOOL);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

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

        public function getItemID()
        {
            return $this->_itemId;
        }

        public function getNextItemId() 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'item';";
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

        public function getItemName()
        {
            return $this->_itemName;
        }

        public function setItemName(string $itemName, int $itemId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET itemName=:itemName WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_itemName = $itemName;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getPhoto()
        {
            return $this->_photo;
        }

        public function setPhoto(string $photoPath, int $itemId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET photo=:photo WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':photo', $photoPath, PDO::PARAM_STR);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_photo = $photoPath;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getPrice()
        {
            return $this->_price;
        }

        public function setPrice(string $price, int $itemId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET price=:price WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':price', $price, PDO::PARAM_STR);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_price = $price;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getSalePrice()
        {
            if (!$this->_salePrice)
            {
                return 0;
            }

            return $this->_salePrice;
        }

        public function setSalePrice(string $salePrice, int $itemId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET salePrice=:salePrice WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':salePrice', $salePrice, PDO::PARAM_STR);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_salePrice = $salePrice;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getDescription()
        {
            return $this->_description;
        }

        public function setDescription(string $description, int $itemId)
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET description=:description WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_description = $description;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function itemIsFeatured()
        {
            return $this->_featured;
        }

        public function setFeatured($featured, int $itemId) 
        {
            if (!$featured) 
            {
                $featured = false; 
            }

            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET featured=:featured WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':featured', $featured, PDO::PARAM_BOOL);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_featured = $featured;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getCategoryId()
        {
            return $this->_categoryId;
        }

        public function setCategoryId(int $categoryId, int $itemId) 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "UPDATE item SET categoryId=:categoryId WHERE itemId=:itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

                $this->_db->executeNonQuery($stmt);

                return $this->_categoryId = $categoryId;
            } 
            catch (PDOException $e) 
            {
                throw $e;
            }
        }

        public function getItem(int $id)
        {
            try 
            {
                $pdo = $this->_db->connect();

                $sql = "SELECT itemId, itemName, photo, price, salePrice, description, featured, categoryId FROM item WHERE itemId = :itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':itemId', $id, PDO::PARAM_INT);

                $rows = $this->_db->executeSQL($stmt);

                if ($stmt->rowCount() == 0) {
                    return -1;
                }

                // Get first row, as it is a primary key, there will only be one row
                $row = $rows[0];

                $this->_itemId = $row["itemId"];
                $this->_itemName = $row["itemName"];
                $this->_photo = $row["photo"];
                $this->_price = $row["price"];
                $this->_salePrice = $row["salePrice"];
                $this->_description = $row["description"];
                $this->_featured = $row["featured"];
                $this->_categoryId = $row["categoryId"];

                return $this->_categoryId;
            }
            catch (PDOException $e)
            {
                throw $e;
            }
        }
        
        public function getItems()
        {
            try 
            {
                $pdo = $this->_db->connect();
    
                $sql = "SELECT itemId, itemName, photo, price, salePrice, description, featured, categoryId FROM item";
                $stmt = $pdo->prepare($sql);
                
                $rows = $this->_db->executeSQL($stmt);

                return $rows;
            }
            catch (PDOException $e)
            {
                throw $e;
            }
        }

        public function getItemsByCategoryId(int $categoryId)
        {
            try 
            {
                $pdo = $this->_db->connect();
    
                $sql = "SELECT itemId, itemName, photo, price, salePrice, `description` FROM item WHERE categoryId = :categoryId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

                $rows = $this->_db->executeSQL($stmt);

                return $rows;
            }
            catch (PDOException $e)
            {
                throw $e;
            }
        }

        public function getItemsByName(string $name)
        {
            try
            {
                $pdo = $this->_db->connect();
                $sql = "SELECT itemId, itemName, photo, price, salePrice, `description` FROM item WHERE itemName LIKE :itemName";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":itemName", "%$name%");
                $rows = $this->_db->executeSQL($stmt);
                return $rows;
            }
            catch (PDOException $e)
            {
                throw $e;
            }
        }

        public function deleteItem(int $itemId) 
        {
            try 
            {
                $pdo = $this->_db->connect();
                
                $sql = "DELETE FROM item WHERE itemId = :itemId";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);

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