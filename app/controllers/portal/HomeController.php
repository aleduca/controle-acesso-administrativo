<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;

class HomeController extends ContainerController {

	public function index() {

		$this->view([
			'name' => 'Alexandre',
			'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus amet soluta quisquam possimus officia voluptatem magni minus, modi cupiditate ipsum culpa. Iste tempore labore numquam dolorem ratione dolore repellendus qui?',
		], 'portal.home');
	}

}