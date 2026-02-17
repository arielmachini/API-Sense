<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

/**
 * Controller for handling Usability Attributes.
 * @see \App\Models\Attribute
 */
class AttributeController extends Controller {
    public static function index() {
        return Attribute::all();
    }
}