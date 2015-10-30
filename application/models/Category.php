<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{
 protected $_name = "category";
    
    function addCategory($data){
        $row = $this->createRow();
        $row->title = $data['title'];
        $row->picture = $data['picture'];
        
         
        return $row->save();
        
    }
    
    function listCategory(){
        
        return $this->fetchAll()->toArray();
    }
    
     function deleteCategory($id){
        return $this->delete("id=$id");
    }
    
    
      function getCategoryById($id){
        return $this->find($id)->toArray();
    }
    
  
       function editCategory($data){
           if(empty($data['picture']))
           {
               unset($data['picture']);
           }
        $this->update($data, "id=" . $data['id']);
        return $this->fetchAll()->toArray();
    }

}

