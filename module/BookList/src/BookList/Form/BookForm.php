<?php
namespace BookList\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Text;


class BookForm extends Form {
    public function __construct($name = null){
        
        parent::__construct('book');
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
    
/*
        $this->add(array(
            'name' => 'author',
            'type' => 'text',
            'options' => array(
                'label' => 'author',
            ),
        ));
 */       

        $authorTextInput = new Element\Text($name = 'author');
        $authorTextInput->setLabel('author');
        $this->add($authorTextInput);

/*
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));        
*/

        $submitButton = new Element\Submit($name = 'submit');
        $submitButton->setAttribute('value', 'Go');
        $submitButton->setAttribute('id', 'submitButton');
        $this->add($submitButton);

    }
}
