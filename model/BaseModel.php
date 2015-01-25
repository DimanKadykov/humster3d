<?php

/**
 * Description of BaseModel
 *
 * @author dmitri
 */
class BaseModel
{
    protected $db;    
    protected $id;    
    protected $created_at;
    protected $table_name;
    protected $dbFields = [];
    
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }
    
    public function fromArray($data)
    {
        foreach($data as $key => $value) {
            $methodName = 'set' . str_replace('_', '', $key);
            
            if(method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
        
        return $this;
    }
    
    public function toArray()
    {
        $out = [];

        foreach ($this->dbFields as $dbField) 
        {
            $methodName = 'get' . str_replace('_', '', $dbField);
            $out[$dbField] = $this->$methodName();
        }
        
        return $out;
    }
    
    public function save()
    {
        $data = $this->toArray();
        
        $fileds = array_keys($data);
        
        $filedsStr = join(', ', $fileds);
        $placeholdersStr = str_repeat('?, ', sizeof($fileds) - 1) . '?';
        
        $sql = 'INSERT INTO ' . $this->table_name . ' ('. $filedsStr .')  ' . ' VALUES (' . $placeholdersStr . ')';
        $stmt = $this->db->prepare($sql);
        
        $placeHolder = 1;
        foreach($data as $value)
        {
            $stmt->bindValue($placeHolder, $value);
            echo $placeHolder . ' => ' . $value . '<br />';
            ++$placeHolder;
        }
        
        $stmt->execute();
    }
    
}
