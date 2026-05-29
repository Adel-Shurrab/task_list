<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show()
    {
        $departments = [
            1 => 'Human Resources',
            2 => 'Engineering',
            3 => 'Sales',
            4 => 'Marketing',
            5 => 'Finance',
        ];

        return view('form.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $department = $request->input('department');

        $departments = [
            1 => 'Human Resources',
            2 => 'Engineering',
            3 => 'Sales',
            4 => 'Marketing',
            5 => 'Finance',
        ];

        $departmentName = $departments[$department] ?? 'Unknown';

        return view('form.index', compact('departments', 'name', 'departmentName'))
            ->with('submitted', true);
    }
}
