<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\DatabaseAvailability;
use Illuminate\Http\Request;

class BottleneckController extends Controller
{
    public function index(Request $request)
    {
        $data = DatabaseAvailability::fallback(function () use ($request) {
            return [
                'cpus' => Product::where('type', 'cpu')->get(),
                'gpus' => Product::where('type', 'gpu')->get(),
                'selectedCpuId' => Product::where('id', $request->cpu_id)
                    ->where('type', 'cpu')
                    ->value('id'),
                'selectedGpuId' => Product::where('id', $request->gpu_id)
                    ->where('type', 'gpu')
                    ->value('id'),
                'databaseWarning' => null,
            ];
        }, [
            'cpus' => collect(),
            'gpus' => collect(),
            'selectedCpuId' => null,
            'selectedGpuId' => null,
            'databaseWarning' => DatabaseAvailability::warningMessage(),
        ]);

        return view('bottleneck.index', $data);
    }

    public function calculate(Request $request)
    {
        return DatabaseAvailability::fallback(function () use ($request) {
            $cpu = Product::find($request->cpu_id);
            $gpu = Product::find($request->gpu_id);

            $cpuScore = $cpu->benchmark_score;
            $gpuScore = $gpu->benchmark_score;

            $maxScore = max($cpuScore, $gpuScore);
            $diff = abs($cpuScore - $gpuScore);

            $bottleneck = ($diff / $maxScore) * 100;
            $type = $cpuScore < $gpuScore ? 'cpu' : 'gpu';

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
        }, fn () => redirect()->route('bottleneck.index')->with('error', DatabaseAvailability::warningMessage()));
    }
}
