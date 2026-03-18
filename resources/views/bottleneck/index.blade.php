@extends('layouts.main')

@section('title', 'Bottleneck Calculator')

@section('content')

<link rel="stylesheet" href="{{ asset('css/seanstyles.css') }}">

<div class="bottleneck-page">
    <div class="bottleneck-hero">
        <h1 class="bottleneck-title">Bottleneck Calculator</h1>
        <p class="bottleneck-subtext">
            Compare a CPU and GPU pairing to see which component is likely holding the system back.
        </p>
    </div>

    <div class="bottleneck-card">
        <form action="{{ route('bottleneck.calculate') }}" method="POST" class="bottleneck-form">
            @csrf

            <div class="bottleneck-field">
                <label for="cpu_id">Choose CPU</label>
                <select name="cpu_id" id="cpu_id" required>
                    @foreach($cpus as $cpu)
                        <option value="{{ $cpu->id }}">{{ $cpu->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bottleneck-field">
                <label for="gpu_id">Choose GPU</label>
                <select name="gpu_id" id="gpu_id" required>
                    @foreach($gpus as $gpu)
                        <option value="{{ $gpu->id }}">{{ $gpu->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bottleneck-submit">Calculate</button>
        </form>
    </div>
</div>

@endsection