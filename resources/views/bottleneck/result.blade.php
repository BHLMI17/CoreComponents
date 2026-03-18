@extends('layouts.main')

@section('title', 'Bottleneck Result')

@section('content')

<link rel="stylesheet" href="{{ asset('css/seanstyles.css') }}">

<div class="bottleneck-page">
    <div class="bottleneck-hero">
        <h1 class="bottleneck-title">Bottleneck Result</h1>
        <p class="bottleneck-subtext">
            Here’s the outcome for the selected CPU and GPU combination.
        </p>
    </div>

    <div class="bottleneck-card">
        <div class="bottleneck-result-grid">
            <div class="bottleneck-stat bottleneck-product-stat">
                <div class="bottleneck-stat-label">CPU</div>
                @if(!empty($cpu->image_url))
                    <img src="{{ $cpu->image_url }}" alt="{{ $cpu->name }}" class="bottleneck-product-img">
                @endif
                <div class="bottleneck-stat-value">{{ $cpu->name }}</div>
            </div>

            <div class="bottleneck-stat bottleneck-product-stat">
                <div class="bottleneck-stat-label">GPU</div>
                @if(!empty($gpu->image_url))
                    <img src="{{ $gpu->image_url }}" alt="{{ $gpu->name }}" class="bottleneck-product-img">
                @endif
                <div class="bottleneck-stat-value">{{ $gpu->name }}</div>
            </div>
        </div>

        <div class="bottleneck-outcome">
            <div class="bottleneck-percent">{{ $bottleneck }}%</div>

            @if($type === 'cpu')
                <p class="bottleneck-message">
                    Your <strong>CPU</strong> is bottlenecking your GPU.
                </p>
            @else
                <p class="bottleneck-message">
                    Your <strong>GPU</strong> is bottlenecking your CPU.
                </p>
            @endif

            <div class="bottleneck-severity">
                Severity: {{ $severity }}
            </div>
        </div>

        <div class="bottleneck-actions">
            <a href="{{ route('bottleneck.index') }}" class="bottleneck-link">Calculate Again</a>
        </div>
    </div>
</div>

@endsection