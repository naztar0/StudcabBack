<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Speciality;
use App\Models\Program;
use App\Models\Cathedra;
use App\Models\Specialization;
use App\Filters\GroupFilters;

class SpecializationController extends Controller
{
    public function index(GroupFilters $filters)
    {
        return response($filters->apply(Specialization::class)
            ->paginate($filters->itemsNum, ['*'], 'page', $filters->pageNum));
    }

    public function show(Specialization $specialization)
    {
        return $specialization;
    }

    public function getCathedraSpecializations(Cathedra $cathedra)
    {
        return response($cathedra->specializations()->get());
    }

    public function getProgramSpecializations(Program $program)
    {
        return response($program->cathedras()->with('specializations')->get());
    }

    public function getSpecialitySpecializations(Speciality $speciality)
    {
        return response($speciality->programs()->with('cathedras.specializations')->get());
    }

    public function getFacultySpecializations(Faculty $faculty)
    {
        return response($faculty->specialities()->with('programs.cathedras.specializations')->get());
    }
}
