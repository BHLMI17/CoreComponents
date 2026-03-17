<link rel="stylesheet" href="{{ asset('css/productoverview.css') }}">

<h1>Bottleneck Calculator</h1>

<form action="{{ route('bottleneck.calculate') }}" method="POST">
    @csrf

    <label>Choose CPU:</label>
    <select name="cpu_id" required>
        @foreach($cpus as $cpu)
            <option value="{{ $cpu->id }}">{{ $cpu->name }}</option>
        @endforeach
    </select>

    <label>Choose GPU:</label>
    <select name="gpu_id" required>
        @foreach($gpus as $gpu)
            <option value="{{ $gpu->id }}">{{ $gpu->name }}</option>
        @endforeach
    </select>

    <button type="submit">Calculate</button>
</form>