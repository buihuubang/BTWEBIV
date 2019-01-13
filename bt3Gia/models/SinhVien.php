<?php
    class SinhVien {
        private $conn;
        private $table_sinhvien= "sinhvien";
        private $table_ketqua = "ketqua";
        private $table_monhoc = "monhoc"; 

        public $MaSV;
        public $TenSV;
        public $DiaChi;
        public $HocKi;
        public $Nam;
        public $Diem;
        public $SoTC;

        public function __construct($db){
            $this->conn = $db;
        }

        // Lay data ve
        function getSV(){
        
            // select all query
            $query = "SELECT sv.MaSV, sv.TenSV, sv.DiaChi, kq.HocKi, kq.Nam, kq.Diem, mh.TenMH 
                      FROM ".$this->table_ketqua." as kq
                      LEFT JOIN ".$this->table_sinhvien." AS sv ON sv.MaSV = kq.MaSV
                      LEFT JOIN ".$this->table_monhoc." AS mh ON mh.MaMH = kq.MaMH
                      WHERE sv.MaSV = kq.MaSV AND mh.MaMH = kq.MaMH";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;

        }


        function findSV(){
        
            // select all query
            $query = "SELECT sv.MaSV, sv.TenSV, sv.DiaChi, kq.HocKi, kq.Nam, kq.Diem, mh.TenMH 
                      FROM ".$this->table_ketqua." as kq
                      LEFT JOIN ".$this->table_sinhvien." AS sv ON sv.MaSV = kq.MaSV
                      LEFT JOIN ".$this->table_monhoc." AS mh ON mh.MaMH = kq.MaMH
                      WHERE sv.MaSV = '".$this->MaSV."' AND mh.MaMH = kq.MaMH AND kq.HocKi = ".$this->HocKi." AND kq.Nam = ".$this->Nam."";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;

        }

    }
?>