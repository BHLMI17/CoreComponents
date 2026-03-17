<h1>Bottleneck Result</h1>

<p><strong>CPU:</strong> {{ $cpu->name }}</p>
<p><strong>GPU:</strong> {{ $gpu->name }}</p>

@if($type === 'cpu')
    <p>Your <strong>CPU</strong> is bottlenecking your GPU by <strong>{{ $bottleneck }}%</strong>.</p>
@else
    <p>Your <strong>GPU</strong> is bottlenecking your CPU by <strong>{{ $bottleneck }}%</strong>.</p>
@endif

<p><strong>Severity:</strong> {{ $severity }}</p>

<a href="{{ route('bottleneck.index') }}">Calculate Again</a>