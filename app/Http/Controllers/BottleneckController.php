<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BottleneckController extends Controller
{
    public function index()
    {
        $cpus = Product::where('type', 'cpu')->get();
        $gpus = Product::where('type', 'gpu')->get();

        return view('bottleneck.index', compact('cpus', 'gpus'));
    }

    public function calculate(Request $request)
    {
        $cpu = Product::find($request->cpu_id);
        $gpu = Product::find($request->gpu_id);

        // Calc Logic
        $cpuScore = $cpu->benchmark_score;
        $gpuScore = $gpu->benchmark_score;

        $maxScore = max($cpuScore, $gpuScore);
        $diff = abs($cpuScore - $gpuScore);

        $bottleneck = ($diff / $maxScore) * 100;

        // Determine bottleneck type
        $type = $cpuScore < $gpuScore ? 'cpu' : 'gpu';


        // Determine severity
        if ($bottleneck <= 10) {
            $severity = 'Balanced';
        } elseif ($bottleneck <= 20) {
            $severity = 'Minor bottleneck';
        } elseif ($bottleneck <= 35) {
            $severity = 'Moderate bottleneck';
        } else {
            $severity = 'Severe bottleneck';
        }

        return view('bottleneck.result', [
            'cpu' => $cpu,
            'gpu' => $gpu,
            'bottleneck' => round($bottleneck),
            'type' => $type,
            'severity' => $severity,
        ]);
    }
}