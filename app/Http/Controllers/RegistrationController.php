<?php

namespace App\Http\Controllers;

use App\Actions\RegistrationAction;
use App\Http\Requests\RegistrationRequest;
use App\Models\VaccineCenter;
use App\Services\VaccineCenterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(VaccineCenterService $centerService)
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request, RegistrationAction $action): RedirectResponse
    {
        try {
            $action->handle($request->all());
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->error($exception->getMessage());
        }

        return redirect()->route('home')->success(__('Registration successful!'));
    }

}
