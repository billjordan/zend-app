<?php
namespace BookList\Model;

use Zend\Db\TableGateway\TableGateway;

class BookTable {
    private $tableGateway;

    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function fetchAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }


    public function getBook($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    
    public function saveBook(Book $book){
        $data = array (
            'title' => $book->title,
            'author' => $book->author,
        );

        $id = (int) $book->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBook($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Book id does not exist');
            }
        }
    }


    public function deleteBook($id){
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
