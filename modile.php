<?php
include_once("./env.php");
class todolist {
    public $conection;
    public $select;
    public $where;
    function __construct()
    {
        $this->conection = mysqli_connect(SERVERHOST,USERNAME,PASSWORD,DATABASENAME);
    }
    function select($col, $table){
        // echo "SELECT $col FROM `$table` ";die;
        $this->select = "SELECT $col FROM `$table` ";
        return $this;
    }
    function where($col, $val){
        $this->select .= "WHERE `$col` = $val";
        return $this;
    }
    function andWhere($col, $val){
        $this->select .= "AND `$col` = $val";
        return $this;
    }
    function orWhere($col, $val){
        $this->select .= "OR `$col` = $val";
        return $this;
    }
    function print(){
        $q = mysqli_query($this->conection, $this->select);
        $data = [];
        while ($row = mysqli_fetch_assoc($q)) {
            $data[] = $row;
        }
        return $data;
    }
    function insert($title, $det, $dateCreate){
        mysqli_query($this->conection, "INSERT INTO `1` (`title`, `details`, `dateCreate`) VALUES ('$title', '$det', '$dateCreate')");
        return $this;
    }
    // UPDATE `1` SET `id`='[value-1]',`title`='[value-2]',`details`='[value-3]',`dateCreate`='[value-4]' WHERE 1
    function update($id, $title, $details, $dateCreate){
        echo "UPDATE `1` SET `title`='$title',`details`='$details',`dateCreate`='$dateCreate' WHERE `id` = $id";die;
        mysqli_query($this->conection, "UPDATE `1` SET `title`='$title',`details`='$details',`dateCreate`='$dateCreate' WHERE `id` = $id");
        return $this;
    }
        function delete($id){
        mysqli_query($this->conection, "DELETE FROM `1` WHERE `id` = $id");
        return $this;
    }
}
