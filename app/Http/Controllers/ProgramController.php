<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Speciality;
use App\Models\Program;
use App\Filters\GroupFilters;

class ProgramController extends Controller
{
    public function index(GroupFilters $filters)
    {
        return response($filters->apply(Program::class)
            ->paginate($filters->itemsNum, ['*'], 'page', $filters->pageNum));
    }

    public function show(Program $program)
    {
        return $program;
    }

    public function getSpecialityPrograms(Speciality $speciality)
    {
        return response($speciality->programs()->get());
    }

    public function getFacultyPrograms(Faculty $faculty)
    {
        return response($faculty->specialities()->with('programs')->get());
    }
}
