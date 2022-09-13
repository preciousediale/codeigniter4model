<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel {

    //protected $table='afrolet_ads';
    protected $db;
    public function __construct(ConnectionInterface & $db){

        $this->db=db_connect();
    }


    public function resultSelectAll($table, $condition){
        $this->builder=$this->db->table($table);

        $this->builder->where($condition);
        //$this->builder->limit(500);
        return $this->builder->get()->getResult();

    }


    
    public function rowSelectAll($table, $condition){
        $this->builder=$this->db->table($table);

        $this->builder->where($condition);
        
        return $this->builder->get()->getRow();
        

    }

    
    
    public function sumRows($table, $condition,$column){
        $this->builder=$this->db->table($table);
        $this->builder->selectSum($column);
        $this->builder->where($condition);
        
        return $this->builder->get()->getRow();
        

    }

    public function rowSelectColumn($table,$columns, $condition){
        $this->builder=$this->db->table($table);
        
        $this->builder->select($columns);
        $this->builder->where($condition);
        
        return $this->builder->get()->getRow();
     //  echo '<br><br><br><br>'.json_encode($this->db->error());

    }

    
    
    public function resultSelectColumn($table,$columns, $condition){
        $this->builder=$this->db->table($table);

        $this->builder->select($columns);
        $this->builder->where($condition);
        $this->builder->orderBy('id desc');
        
        return $this->builder->get()->getResult();

    }


    
    
    public function sortSelectColumn($table,$columns, $condition,$sort,$limit){
        $this->builder=$this->db->table($table);

        $this->builder->select($columns);
        $this->builder->where($condition);
        $this->builder->orderBy($sort);
        $this->builder->limit($limit);
        
        return $this->builder->get()->getResult();

    }


    
    
    public function joinRowSelectColumn($table_one,$condition,$table_two,$join_cond,$columns){
        $this->builder=$this->db->table($table_one.' as a');

        $this->builder->select($columns);
        $this->builder->where($condition);
        $this->builder->join($table_two.' as b',$join_cond,'inner');
       //echo '<br><br><br><br>'.json_encode($this->db->error());

        return $this->builder->get()->getRow();

    }

    
    
    public function joinResultSelectColumn($table_one,$condition,$table_two,$join_cond_two,$table_three,$join_cond_three,$columns,$order,$type){
        $this->builder=$this->db->table($table_one.' as a');

        $this->builder->where($condition);
        $this->builder->select($columns);
        $this->builder->join($table_two.' as b',$join_cond_two,'inner');

        
        if($table_three!=''){
        $this->builder->join($table_three.' as c',$join_cond_three,$type);
        }
        

        if($order==''){
        $this->builder->orderBy('a.id desc');
        }
        else{
            $this->builder->orderBy($order);
        }

      
        //echo '<br><br><br><br>'.json_encode($this->db->error());
        
        return $this->builder->get()->getResult();

    }



    
    public function sortSelectAll($table,$condition,$sort){
        $this->builder=$this->db->table($table);

        $this->builder->select('*');
        $this->builder->where($condition);
        $this->builder->orderBy($sort);
        
        return $this->builder->get()->getResult();

    }





    public function insertData($table,$data=array()){
       
        if($this->db->table($table)->insert($data)){
       //echo '<br><br><br><br>----'.json_encode($this->db->error());
         return true;
        }
        }




    


    public function insertBulk($table,$data=array()){
       
        $this->db->table($table)->insertBatch($data);
    //  echo '<br><br><br><br>----'.json_encode($this->db->error());
         return true;
        
        }


        
    public function updateData($table,$condition,$data){
        $this->builder=$this->db->table($table);
        $this->builder->set($data);
        $this->builder->where($condition);
        $this->builder->update();
        //echo '<br><br><br><br><br>'.json_encode($this->db->error());
        return true;
       
        }



        
        public function deleteData($table,$condition){
            $this->builder=$this->db->table($table);
            $this->builder->where($condition);
            $this->builder->delete();
            return true;
           //echo '<br><br><br><br><br>'.json_encode($this->db->error());
            }
    
    


    public function rowCustomQuery($sql){
        
        $query=$this->db->query($sql);
        
        return $query->getRow();
         
    }

    
    public function resultCustomQuery($sql){
        
        $query=$this->db->query($sql);
        //echo '<br><br><br><br><br>'.json_encode($this->db->error());
        return $query->getResult();
         
    }



    public function customEscapedQuery($query,$param){

        $query=$this->db->query($query, $param);
        $query=$query->getResult();
     //   echo '<br><br><br><br><br>'.json_encode($this->db->error());
        return $query;

    }



  
        
        
}
