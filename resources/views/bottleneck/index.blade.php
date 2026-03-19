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

            <div class="bottleneck-select-row">
                <div class="bottleneck-field">
                    <label for="cpu_id">Choose CPU</label>
                    <select name="cpu_id" id="cpu_id" required>
                        @foreach($cpus as $cpu)
                            <option
                                value="{{ $cpu->id }}"
                                data-name="{{ $cpu->name }}"
                                data-image="{{ $cpu->image_url }}"
                            >
                                {{ $cpu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="bottleneck-field">
                    <label for="gpu_id">Choose GPU</label>
                    <select name="gpu_id" id="gpu_id" required>
                        @foreach($gpus as $gpu)
                            <option
                                value="{{ $gpu->id }}"
                                data-name="{{ $gpu->name }}"
                                data-image="{{ $gpu->image_url }}"
                            >
                                {{ $gpu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="bottleneck-result-grid bottleneck-preview-grid">
                <div class="bottleneck-stat bottleneck-product-stat">
                    <div class="bottleneck-stat-label">Selected CPU</div>
                    <img src="" alt="" class="bottleneck-product-img" id="cpuPreviewImg">
                    <div class="bottleneck-stat-value" id="cpuPreviewName"></div>
                </div>

                <div class="bottleneck-stat bottleneck-product-stat">
                    <div class="bottleneck-stat-label">Selected GPU</div>
                    <img src="" alt="" class="bottleneck-product-img" id="gpuPreviewImg">
                    <div class="bottleneck-stat-value" id="gpuPreviewName"></div>
                </div>
            </div>

            <div class="bottleneck-form-actions">
                <button type="submit" class="bottleneck-submit">Calculate</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updatePreview(selectId, imgId, nameId) {
        const select = document.getElementById(selectId);
        const selectedOption = select.options[select.selectedIndex];
        const image = selectedOption.getAttribute('data-image');
        const name = selectedOption.getAttribute('data-name');

        const imgEl = document.getElementById(imgId);
        const nameEl = document.getElementById(nameId);

        imgEl.src = image || '';
        imgEl.alt = name || '';
        nameEl.textContent = name || '';
    }

    function refreshBottleneckPreviews() {
        updatePreview('cpu_id', 'cpuPreviewImg', 'cpuPreviewName');
        updatePreview('gpu_id', 'gpuPreviewImg', 'gpuPreviewName');
    }

    document.getElementById('cpu_id').addEventListener('change', refreshBottleneckPreviews);
    document.getElementById('gpu_id').addEventListener('change', refreshBottleneckPreviews);

    refreshBottleneckPreviews();
</script>

@endsection