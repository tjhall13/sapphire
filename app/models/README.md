# app/models/
The model finds and saves resources in the application. The model *must* implement a static function `find` that takes a single id and retuns an instance of the model.

It would be best to create an abstract class that implements that static method allowing all models implement specific code only.

The model must be in the `App\Models` namespace.

## Example
```
<?php

namespace App\Models;

class Test {
	public static function all() {
		return [ new self(1), new self(2), new self(3) ];
	}

	public static function find($id) {
		return new self($id);
	}

	private $id;
	private $value;

	public function __construct($id) {
		$this->id = $id;
		$this->value = rand();
	}

	public function getID() {
		return $this->id;
	}

	public function getValue() {
		return $this->value;
	}
}
```
