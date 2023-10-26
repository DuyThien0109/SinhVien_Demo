


<?php 

    class SinhVien
    {
        private $Id;
        private $Name;
        private $DateOfBirth;
        private $Sex;
        private $Score;

        
        
        public function __construct($Id, $Name, $DateOfBirth, $Sex, $Score)
        {
            $this->Id = $Id;
            $this->Name = $Name;
            $this->DateOfBirth = $DateOfBirth;
            $this->Sex = $Sex;
            $this->Score = $Score;
        }
        /**
         * Get the value of Name
         */
        public function getName()
        {
                return $this->Name;
        }

        /**
         * Set the value of Name
         */
        public function setName($Name): self
        {
                $this->Name = $Name;

                return $this;
        }

        /**
         * Get the value of DateOfBirth
         */
        public function getDateOfBirth()
        {
                return $this->DateOfBirth;
        }

        /**
         * Set the value of DateOfBirth
         */
        public function setDateOfBirth($DateOfBirth): self
        {
                $this->DateOfBirth = $DateOfBirth;

                return $this;
        }

        /**
         * Get the value of Sex
         */
        public function getSex()
        {
                return $this->Sex;
        }

        /**
         * Set the value of Sex
         */
        public function setSex($Sex): self
        {
                $this->Sex = $Sex;

                return $this;
        }

        /**
         * Get the value of Score
         */
        public function getScore()
        {
                return $this->Score;
        }

        /**
         * Set the value of Score
         */
        public function setScore($Score): self
        {
                $this->Score = $Score;

                return $this;
        }
        

        /**
         * Get the value of Id
         */ 
        public function getId()
        {
                return $this->Id;
        }

        /**
         * Set the value of Id
         *
         * @return  self
         */ 
        public function setId($Id)
        {
                $this->Id = $Id;

                return $this;
        }
    }	

	

	

	
?>