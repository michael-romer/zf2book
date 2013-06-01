<?php
namespace Helloworld\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ProductController extends AbstractRestfulController
{
    private $products = array(
        array(
            'name' => 'Boxfresh SPARKO 4 Sneaker',
            'price' => 84.95
        ),
        array(
            'name' => 'adidas Originals Samba',
            'price' => 64.95
        )
    );

    public function getList()
    {
        return new JsonModel(
            $this->products
        );
    }

	public function get($id)
    {
	    // [..]
    }

	public function create($data)
    {
        // [..]
    }

	public function update($id, $data)
    {
        // [..]
    }

	public function delete($id)
    {
        // [..]
    }
}