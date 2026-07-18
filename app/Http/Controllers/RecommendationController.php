<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use App\Models\WeightProfile;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected RecommendationService $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    /**
     * Halaman homepage.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Halaman form input budget & kebutuhan.
     */
    public function form()
    {
        return view('rekomendasi.form');
    }

    /**
     * Proses form, hitung rekomendasi, tampilkan hasil.
     */
    public function proses(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:1000000',
            'kebutuhan' => 'required|in:gaming,editing,office',
        ]);

        $hasil = $this->recommendationService->rekomendasikan(
            (float) $request->budget,
            $request->kebutuhan
        );

        return view('rekomendasi.hasil', ['hasil' => $hasil]);
    }
}