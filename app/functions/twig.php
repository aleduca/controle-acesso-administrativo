<?php

$this->functions[] = $this->functionToView('flash', function ($key) {
	return (new app\classes\Flash)->get($key);
});