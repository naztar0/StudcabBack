<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Speciality;
use App\Models\Program;
use App\Models\Cathedra;
use App\Filters\GroupFilters;

class CathedraController extends Controller
{
    public function index(GroupFilters $filters)
    {
        return response($filters->apply(Cathedra::class)
            ->paginate($filters->itemsNum, ['*'], 'page', $filters->pageNum));
    }

    public function show(Cathedra $cathedra)
    {
        return $cathedra;
    }

    public function getProgramCathedras(Program $program)
    {
        return response($program->cathedras()->get());
    }

    public function getSpecialityCathedras(Speciality $speciality)
    {
        return response($speciality->programs()->with('cathedras')->get());
    }

    public function getFacultyCathedras(Faculty $faculty)
    {
        return response($faculty->specialities()->with('programs.cathedras')->get());
    }
}
