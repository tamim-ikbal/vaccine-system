@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class="container">
        <h2 class="text-black dark:text-white text-center text-2xl font-bold mb-4">
            {{ __('Check Vaccine Status') }}
        </h2>
        <div
            class="max-w-3xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
            <livewire:vaccine.check-status/>
        </div>
    </div>
@endsection
