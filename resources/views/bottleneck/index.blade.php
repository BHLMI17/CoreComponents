@extends('layouts.main')

@section('title', 'Bottleneck Calculator')

@section('content')

<link rel="stylesheet" href="{{ asset('css/seanstyles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

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
                        <option value="" {{ !$selectedCpuId ? 'selected' : '' }} disabled data-name="" data-image="">
                            Select a CPU
                        </option>
                        @foreach($cpus as $cpu)
                            <option
                                value="{{ $cpu->id }}"
                                data-name="{{ $cpu->name }}"
                                data-image="{{ $cpu->image_url }}"
                                {{ (string)$selectedCpuId === (string)$cpu->id ? 'selected' : '' }}
                            >
                                {{ $cpu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="bottleneck-field">
                    <label for="gpu_id">Choose GPU</label>
                    <select name="gpu_id" id="gpu_id" required>
                        <option value="" {{ !$selectedGpuId ? 'selected' : '' }} disabled data-name="" data-image="">
                            Select a GPU
                        </option>
                        @foreach($gpus as $gpu)
                            <option
                                value="{{ $gpu->id }}"
                                data-name="{{ $gpu->name }}"
                                data-image="{{ $gpu->image_url }}"
                                {{ (string)$selectedGpuId === (string)$gpu->id ? 'selected' : '' }}
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
                    <div class="bottleneck-product-placeholder" id="cpuPreviewSlot">
                        <img src="" alt="" class="bottleneck-product-img" id="cpuPreviewImg" style="display: none;">
                    </div>
                    <div class="bottleneck-stat-value" id="cpuPreviewName">No CPU selected</div>
                </div>

                <div class="bottleneck-stat bottleneck-product-stat">
                    <div class="bottleneck-stat-label">Selected GPU</div>
                    <div class="bottleneck-product-placeholder" id="gpuPreviewSlot">
                        <img src="" alt="" class="bottleneck-product-img" id="gpuPreviewImg" style="display: none;">
                    </div>
                    <div class="bottleneck-stat-value" id="gpuPreviewName">No GPU selected</div>
                </div>
            </div>

            <div class="bottleneck-form-actions">
                <button type="submit" class="bottleneck-submit">Calculate</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    function updatePreview(selectId, imgId, nameId, emptyLabel) {
        const select = document.getElementById(selectId);
        const selectedOption = select.options[select.selectedIndex];

        const image = selectedOption ? selectedOption.getAttribute('data-image') : '';
        const name = selectedOption ? selectedOption.getAttribute('data-name') : '';

        const imgEl = document.getElementById(imgId);
        const nameEl = document.getElementById(nameId);

        if (!image || !name || !select.value) {
            imgEl.style.display = 'none';
            imgEl.src = '';
            imgEl.alt = '';
            nameEl.textContent = emptyLabel;
            return;
        }

        imgEl.src = image;
        imgEl.alt = name;
        imgEl.style.display = 'block';
        nameEl.textContent = name;
    }

    function refreshBottleneckPreviews() {
        updatePreview('cpu_id', 'cpuPreviewImg', 'cpuPreviewName', 'No CPU selected');
        updatePreview('gpu_id', 'gpuPreviewImg', 'gpuPreviewName', 'No GPU selected');
    }

    new TomSelect("#cpu_id", {
        create: false,
        allowEmptyOption: true,
        placeholder: "Select a CPU",
        sortField: {
            field: "text",
            direction: "asc"
        },
        onChange: function() {
            refreshBottleneckPreviews();
        }
    });

    new TomSelect("#gpu_id", {
        create: false,
        allowEmptyOption: true,
        placeholder: "Select a GPU",
        sortField: {
            field: "text",
            direction: "asc"
        },
        onChange: function() {
            refreshBottleneckPreviews();
        }
    });

    refreshBottleneckPreviews();
</script>

@endsection