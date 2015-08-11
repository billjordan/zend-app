<?php
namespace BookList\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Book implements InputFilterAwareInterface {
    public $id;
    public $title;
    public $author;

    protected $intputFilter;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->author = (!empty($data['author'])) ? $data['author'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }


    public function setInputFilter(InputFilterInterface $intputFilter) {
        throw new \Exception("not used");
    }

    
    public function getInputFilter() {
        if (!$this->intputFilter) {
            $intputFilter = new InputFilter();
            
            $intputFilter->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));        
            
            $intputFilter->add(array(
                'name' => 'author',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $intputFilter->add(array(
                'name' => 'title',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $this->intputFilter = $intputFilter;
        }
        return $this->intputFilter;
    }
}
