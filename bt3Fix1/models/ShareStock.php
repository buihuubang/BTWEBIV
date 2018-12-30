<?php
    class ShareStock {
        private $conn;
        private $table_giaodich= "giaodich";
        private $table_thang = "thang";
        private $table_congty = "congty"; 

        public $Thang;
        public $TenCT;
        public $Mua;
        public $Ban;
        public $MaCT;

        public function __construct($db){
            $this->conn = $db;
        }

        // Lay data ve
        function getStock(){
        
            // select all query
            $query = "SELECT t.Thang,g.MaCT, c.TenCT, g.Mua, g.Ban 
                      FROM ".$this->table_giaodich." as g 
                      LEFT JOIN ".$this->table_thang." as t ON g.MaThang = t.MaThang
                      LEFT JOIN ".$this->table_congty." as c ON g.MaCT = c.MaCT
                      WHERE t.MaThang = g.MaThang AND c.MaCT = g.MaCT";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;

        }

        function createStock(){
            //Check query
            $checkQuery = "SELECT * FROM ".$this->table_giaodich." WHERE MaThang='".$this->Thang."' AND MaCT='".$this->MaCT."'";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->execute();
            $checkResult = $checkStmt->fetchColumn(); 
            if($checkResult > 0){
                return false;
            } else {
                // select all query
                $query = "INSERT INTO ".$this->table_giaodich."(MaThang,MaCT,Mua,Ban) 
                        VALUES ('".$this->Thang."','".$this->MaCT."',".$this->Mua.",".$this->Ban.");
                        INSERT INTO ".$this->table_congty."(MaCT,TenCT) 
                        VALUES ('".$this->MaCT."','".$this->TenCT."');";
            
                // prepare query statement
                $stmt = $this->conn->prepare($query);

                // execute query
                if($stmt->execute()){
                    return true;
                }
                return false;
            }
        }

        function updateStock(){
            // select all query
            $query = "UPDATE ".$this->table_giaodich." 
                      SET 
                      MaThang = '".$this->Thang."', 
                      Mua = ".$this->Mua.", 
                      Ban = ".$this->Ban." 
                      WHERE 
                      MaCT = '".$this->MaCT."' AND MaThang = '".$this->Thang."'";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteStock(){
            // select all query
            $query = "DELETE FROM ".$this->table_giaodich." WHERE MaCT='".$this->MaCT."' AND MaThang = '".$this->Thang."'";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function findStock(){
        
            // select all query
            $query = "SELECT t.Thang,g.MaCT, c.TenCT, g.Mua, g.Ban 
                      FROM ".$this->table_giaodich." as g 
                      LEFT JOIN ".$this->table_thang." as t ON g.MaThang = t.MaThang
                      LEFT JOIN ".$this->table_congty." as c ON g.MaCT = c.MaCT
                      WHERE t.MaThang = g.MaThang AND c.MaCT = g.MaCT AND g.MaCT = '".$this->MaCT."' AND t.MaThang='".$this->Thang."'";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;

        }

    }
?>