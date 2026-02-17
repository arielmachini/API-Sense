<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

/**
 * Controller for handling REST API Components.
 * @see \App\Models\Component
 */
class ComponentController extends Controller {
    public static function index() {
        return Component::all();
    }
}