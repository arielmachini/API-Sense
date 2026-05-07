<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class SourceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('sources', [
            'sources' => Source::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Source $source) {
        return view('sources', [
            'source' => Source::findOrFail($source)
        ]);
    }
}
