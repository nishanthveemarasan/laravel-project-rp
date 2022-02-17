<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\RolePermissionService;
use App\Http\Requests\PermissionCreateRequest;

class PermissionController extends Controller
{
    public $result;
    public $service;

    public function __construct(RolePermissionService $service)
    {
        $this->service = $service;
    }

    public function add(PermissionCreateRequest $request)
    {
        try {
            $this->result = $this->service->addPermission($request->validated());
        } catch (Exception $e) {
            $this->result['error']['message'] = $e->getMessage();
        }
        return $this->result;
    }

    public function remove(PermissionCreateRequest $request)
    {
        try {
            $this->result = $this->service->removePermission($request->validated());
        } catch (Exception $e) {
            $this->result['error']['message'] = $e->getMessage();
        }
        return $this->result;
    }
}
