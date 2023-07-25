<?php
class Database 
{
    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';
    private $con = null;
    
    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function connect() : bool
    {
        $flag=true;
        try
        {
            if (!$this->con) 
            {
                $this->con = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            }
            else
            {
                $flag=false;
            }
        } 
        catch (Exception $e)
        {
            $flag=false;
        }
        return $flag;
    }
    
    public function disconnect() : bool
    {
        $flag=true;
        try
        {
            $this->con->close();
        }
        catch (Exception $e)
        {
            $flag=false;
        }
        return $flag;
   }

   private function tableExists($table) : bool
   {
       $flag = true;
       $tablesInDb = $this->con->query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
       if (!$tablesInDb)
       {
            $flag=false;
       }
       return $flag;
   }   

   public function select($table, $rows = '*', $where = null, $order = null) 
   {
        if ($this->tableExists($table)) 
        {
            $q = 'SELECT '.$rows.' FROM '.$table;
            if ($where != null) $q .= ' WHERE '.$where;
            if ($order != null) $q .= ' ORDER BY '.$order;
    
            try
            {
                $result = $this->con->query($q);
                $arrResult = $result->fetch_all(MYSQLI_ASSOC);
                return $arrResult;
            }
            catch (Exception $e)
            {
                return false;
            }
        }
        else
        {
            return false;
        }
   }

   public function selectInner($table, $rows, $where, $group, $having, $order, $limit) 
   {
        $q = 'SELECT '.$rows.' FROM '.$table;
        if ($where != null && $where != "") $q .= ' WHERE '.$where;
        if ($group != null && $group != "") $q .= ' GROUP BY '.$group;
        if ($having != null && $having != "") $q .= ' HAVING '.$having;
        if ($order != null && $order != "") $q .= ' ORDER BY '.$order;
        if ($limit != null && $limit != "") $q .= ' LIMIT '.$limit;

        try
        {
            $result = $this->con->query($q);
            $arrResult = $result->fetch_all(MYSQLI_ASSOC);
            return $arrResult;
        }
        catch (Exception $e)
        {
            return false;
        }
   }

    public function insert(string $table, array $values, string $rows = null) : bool
    {
        $flag=true;
        $insert = $this->getSQLInsert($table, $values, $rows);
        if ($insert!="") 
        {
            try
            {
                $ins = $this->con->query($insert);
            }
            catch (Exception $e)
            {
                $flag = false;
            }
        }
        else
        {
            $flag = false;
        }
        return $flag;
    }

    public function insertIdentity(string $table, array $values, string $rows = null) : int
    {
        $identity=0;
        $insert = $this->getSQLInsert($table, $values, $rows);
        if ($insert!="") 
        {
            try
            {
                $ins = $this->con->query($insert);
                $identity = $this->con->insert_id;
            }
            catch (Exception $e)
            {
            }
        }
        return $identity;
    }

    private function getSQLInsert(string $table, array $values, string $rows = null) : string
    {
        $insert="";
        if ($this->tableExists($table)) 
        {
            $insert = 'INSERT INTO '.$table;

            if ($rows != null) 
            {
                $insert .= ' ('.$rows.')';
            }
            
            for ($i = 0; $i < count($values); $i++) 
            {
                $values[$i] = mysqli_real_escape_string($this->con, $values[$i]);

                if (is_string($values[$i])) 
                {
                    $values[$i] = '"'.$values[$i].'"';
                }
            }
            $lista = implode(',', $values);
            $insert .= ' VALUES ('.$lista.')';
        }
        return $insert;
    }

    public function delete(string $table, bool $sure=false, string $where = null) : bool
    {
        $flag = true;
        if ($this->tableExists($table)) 
        {
            if ($where == null && $sure) 
            {
                $delete = 'DELETE '. $table; 
            }
            else if ($where == null && !$sure)
            {
                $delete="";
            } 
            else 
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; 
            }
            
            try
            {
                if ($delete)
                {
                    $del = $this->con->query($delete);
                }
                else
                {
                    throw new Exception("Delete vacío");
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage() . "<br/>";
                $flag = false; 
            }
        } 
        else 
        {
            $flag = false; 
        }
        return $flag;
    }
 
    public function update(string $table, array $values, string $where = null)
    {
        $flag=true;
        if ($this->tableExists($table)) 
        {
            $update = 'UPDATE ' . $table . ' SET ';
            
            //Construcción del SET
            $keys = array_keys($values);
            $contador=0;
            foreach ($keys as $key) 
            {
                $contador++;

                $value = mysqli_real_escape_string($this->con, $values[$key]);
                
                //Validar si es string
                if (is_string($value)) 
                {
                    $value = '"'.$value.'"';
                }
                $update .= "$key=$value";

                if ($contador!=count($keys)) $update .=",";
            }

            //Construcción del WHERE
            if ($where != null) $update .= ' WHERE ' . $where;

            try
            {
               $query = $this->con->query($update);
            }
            catch(Exception $e)
            {
                $flag=false;
            }
        } 
        else 
        {
            $flag= false;
        }
        return $flag;
    }
}