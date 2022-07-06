<?php

namespace App\Controllers\Api;

class ApiController
{
    public function __construct()
    {
        // 
    }

	protected function response(array $data): void
	{
		header("Content-Type: application/json");
		echo json_encode($data);
	}
}
