<?php
    class CartItem
    {
        private $_itemName;
        private $_itemDescription;
        private $_itemImage;
        private $_quantity;
        private $_price;
        private $_productId;

        /**
         * Constructor
         */
        public function __construct(string $itemName, string $itemDescription, string $itemImage, int $quantity, float $price, int $productId)
        {
            $this->_itemName = $itemName;
            $this->_itemDescription = $itemDescription;
            $this->_itemImage = $itemImage;
            $this->_quantity = (int)$quantity;
            $this->_price = (float)$price;
            $this->_productId = (int)$productId;
        }

        /**
         * Get quantity
         */
        public function getQuantity()
        {
            return $this->_quantity;
        }

        /**
         * Set quantity
         */
        public function setQuantity(int $value)
        {
            if ($value >= 0)
            {
                $this->_quantity = (int)$value;
            }
            else
            {
                throw new Exception("Quantity must be positive");
            }
        }

        /**
         * Get price
         */
        public function getPrice()
        {
            return $this->_price;
        }

        /**
         * Get Item Id
         */
        public function getItemId()
        {
            return $this->_productId;
        }

        /**
         * Get Item Name
         */
        public function getItemName()
        {
            return $this->_itemName;
        }

        /**
         * Get Item Description
         */
        public function getItemDescription()
        {
            return $this->_itemDescription;
        }

        /**
         * Get Item Photo
         */
        public function getItemImage()
        {
            return $this->_itemImage;
        }
    }
?>