<?php
    require_once "CartItem.php";
    require_once "DBAccess.php";

    class ShoppingCart 
    {
        private $_cartItems = [];
        private $_shoppingOrderId;

        /**
         * Count items in cart
         */
        public function count()
        {
            return count($this->_cartItems);
        }

        /**
         * Sets id of shopping order
         */
        public function setShoppingOrderId(int $id)
        {
            return $this->_shoppingOrderId = (int)$id;
        }

        /**
         * Returns an array of cart items
         */
        public function getItems()
        {
            return $this->_cartItems;
        }

        /**
         * Add CartItem to cart
         */
        public function addItem(CartItem $cartItem)
        {
            $found = $this->inCart($cartItem);

            if($found != null)
            {
                $this->updateItem($cartItem);
            }
            else
            {
                $this->_cartItems[] = $cartItem;
            }
        }

        /**
         * Update cart item with a new CartItem
         */
        public function updateItem(CartItem $cartItem)
        {
            $index = $this->itemIndex($cartItem);

            $oldQty = $this->_cartItems[$index]->getQuantity();
            $additionalQty = $cartItem->getQuantity();

            $newQty = $oldQty + $additionalQty;

            $this->_cartItems[$index]->setQuantity($newQty);
        }

        public function removeItem($cartItem)
        {
            $index = $this->itemIndex($cartItem);

            if ($index >= 0) {
                //remove array element
                unset($this->_cartItems[$index]);
                //reorganise values
                $this->_cartItems = array_values($this->_cartItems);
            }
        }

        /**
         * Calculate total cost of items
         */
        public function calculateTotal()
        {
            $total = 0.0;
            foreach ($this->_cartItems as $item) {
                $total += $item->getQuantity() * $item->getPrice();
            }

            return $total;
        }

        /**
         * Save cart contents
         */
        public function saveCart(
            $Address,
            $ContactNumber,
            $CreditCardNumber,
            $CSV,
            $Email,
            $ExpiryDate,
            $FirstName,
            $LastName,
            $NameOnCard
        ) {
            include "settings/db.php";
            $db = new DBAccess($dsn, $username, $password);
            $pdo = $db->connect();

            $sql = "INSERT INTO shoppingorder(Address, ContactNumber, CreditCardNumber, CSV,
            Email, ExpiryDate, FirstName, LastName, NameOnCard, OrderDate) VALUES(:Address,
            :ContactNumber, :CreditCardNumber, :CSV, :Email, :ExpiryDate, :FirstName, :LastName,
            :NameOnCard, now())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":Address", $Address, PDO::PARAM_STR);
            $stmt->bindValue(":ContactNumber", $ContactNumber, PDO::PARAM_STR);
            $stmt->bindValue(":CreditCardNumber", $CreditCardNumber, PDO::PARAM_STR);
            $stmt->bindValue(":CSV", $CSV, PDO::PARAM_STR);
            $stmt->bindValue(":Email", $Email, PDO::PARAM_STR);
            $stmt->bindValue(":ExpiryDate", $ExpiryDate, PDO::PARAM_STR);
            $stmt->bindValue(":FirstName", $FirstName, PDO::PARAM_STR);
            $stmt->bindValue(":LastName", $LastName, PDO::PARAM_STR);
            $stmt->bindValue(":NameOnCard", $NameOnCard, PDO::PARAM_STR);
            $shoppingOrderID = $db->executeNonQuery($stmt, true);

            // Loop through shopping cart, insert items
            foreach ($this->_cartItems as $item) {
                // Set up insert statement
                $sql = "INSERT INTO orderitem(itemID, price, quantity, shoppingOrderID)
            values(:ItemID, :Price, :Quantity, :shoppingOrderID)";
                // For each item insert a row in OrderItem
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":ItemID", $item->getItemId(), PDO::PARAM_INT);
                $stmt->bindValue(":Price", $item->getPrice(), PDO::PARAM_STR);
                $stmt->bindValue(":Quantity", $item->getQuantity(), PDO::PARAM_INT);
                $stmt->bindValue(":shoppingOrderID", $shoppingOrderID, PDO::PARAM_INT);
                $db->executeNonQuery($stmt);
            }
            $this->_shoppingOrderId = $shoppingOrderID;
            return $shoppingOrderID;
        }

        /**
         * Find cart item
         */
        private function inCart($cartItem)
        {
            $found = null;
            foreach ($this->_cartItems as $item) {
                if ($item->getItemId() == $cartItem->getItemId()) {
                    $found = $item;
                }
            }
            return $found;
        }

        /**
         * Get index of item in cart
         */
        private function itemIndex($cartItem)
        {
            $index = -1;
            for ($i = 0; $i < $this->count(); $i++) {
                if ($cartItem->getItemId() == $this->_cartItems[$i]->getItemId()) {
                    $index = $i;
                }
            }
            return $index;
        }

        /**
         * Clears cart
         */
        public function clearCart($shoppingOrderID) {
            if ($this->_shoppingOrderId == $shoppingOrderID) {
                $this->_cartItems = [];
            }
        }

        /**
         * Testing method
         */
        public function displayArray()
        {
            print_r($this->_cartItems);
        }
    } 
?>