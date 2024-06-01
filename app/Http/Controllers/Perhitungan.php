<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\Kriteria;
use App\Models\Evaluasi;
use App\Models\Periode;
use Illuminate\Http\Request;

class Perhitungan extends Controller
{
    public function hitungCOPRAS()
    {
        
        $alternatives = Datasiswa::all();

        /**
         * 1. Membuat matriks keputusan
         */
        $decisionMatrix = $this->createDecisionMatrix();

        /**
         * 2. Normalisasi matriks (X)
         */
        $alternatives = $this->matrixNormalisation($decisionMatrix);

        /**
         * 3. Menentukan matriks keputusan berbobot yang ternormalisasi (D)
         */
        $normalisationWeigth = $this->normalisedWeightedDecisionMatrix($alternatives);

        /**
         * 4. Perhitungan memaksimalkan(S+i) dan meminimalkan(S-i) indeks untuk masing-masing alternatif.
         */
        $maximisingMinimisingIndex = $this->maximisingMinimisingIndex($normalisationWeigth);

        /**
         * 5. Mentukan bobot relatif (Qi) setiap alternatif
         */
        $relativeWeight = $this->relativeWeight($maximisingMinimisingIndex);

        /**
         * 6.Perhitungan utilitas kuantitatif (Ui) untuk setiap alternatif
         */
        $quantitativeUtility = $this->quantitativeUtility($relativeWeight);

        /**
         * 7. Peringkat
         */
        $ranking = $this->ranking($quantitativeUtility);

        return response()->json($ranking);
    }


        /**
         * 1. Create a decision matrix
         */
    public function createDecisionMatrix()
    {
        $evaluations = Evaluasi::all();

        // sum criteria_1 until criteria_6
        $sum_kriteria_1 = $evaluations->sum('kriteria_1');
        $sum_kriteria_2 = $evaluations->sum('kriteria_2');
        $sum_kriteria_3 = $evaluations->sum('kriteria_3');
        $sum_kriteria_4 = $evaluations->sum('kriteria_4');
        $sum_kriteria_5 = $evaluations->sum('kriteria_5');
        $sum_kriteria_6 = $evaluations->sum('kriteria_6');

        return [
            'sum_kriteria_1' => $sum_kriteria_1,
            'sum_kriteria_2' => $sum_kriteria_2,
            'sum_kriteria_3' => $sum_kriteria_3,
            'sum_kriteria_4' => $sum_kriteria_4,
            'sum_kriteria_5' => $sum_kriteria_5,
            'sum_kriteria_6' => $sum_kriteria_6,
        ];
    }

    /**
     * Matrix normalisation
     */
    public function matrixNormalisation($sum_kriteria)
    {
        $alternatives = Evaluasi::with('alternative')->get();

        $normalisationMatrix = $alternatives->map(function ($alternative) use ($sum_kriteria) {
            return [
                'id' => $alternative->id,
                'id_siswa' => $alternative->id_siswa,
                'id_periode' => $alternative->id_periode,
                'nama_siswa' => $alternative->alternative->nama,
                'kriteria_1' => $alternative->kriteria_1 / $sum_kriteria['sum_kriteria_1'],
                'kriteria_2' => $alternative->kriteria_2 / $sum_kriteria['sum_kriteria_2'],
                'kriteria_3' => $alternative->kriteria_3 / $sum_kriteria['sum_kriteria_3'],
                'kriteria_4' => $alternative->kriteria_4 / $sum_kriteria['sum_kriteria_4'],
                'kriteria_5' => $alternative->kriteria_5 / $sum_kriteria['sum_kriteria_5'],
                'kriteria_6' => $alternative->kriteria_6 / $sum_kriteria['sum_kriteria_6'],
            ];
        });

        return $normalisationMatrix;
    }

    /**
     * 3. Determine the normalised weighted decision matrix (D)
     */
    public function normalisedWeightedDecisionMatrix($normalisationMatrix)
    {
        $weights = Kriteria::all();

        $alternatives = $normalisationMatrix->map(function ($alternative) use ($weights) {
            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                'kriteria_1' => $alternative['kriteria_1'] * $weights[0]->bobot,
                'kriteria_2' => $alternative['kriteria_2'] * $weights[1]->bobot,
                'kriteria_3' => $alternative['kriteria_3'] * $weights[2]->bobot,
                'kriteria_4' => $alternative['kriteria_4'] * $weights[3]->bobot,
                'kriteria_5' => $alternative['kriteria_5'] * $weights[4]->bobot,
                'kriteria_6' => $alternative['kriteria_6'] * $weights[5]->bobot,
            ];
        });

        return $alternatives;
    }

    /**
     * 4. Calculation of maximising (S+i) and minimising (S-i) index for each alternative.
     */
    public function maximisingMinimisingIndex($normalisedWeightedDecisionMatrix)
    {
        $sumKriteria = $normalisedWeightedDecisionMatrix->map(function ($alternative) {
            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                'S+i' => $alternative['kriteria_1'] + $alternative['kriteria_2'] + $alternative['kriteria_3'] + $alternative['kriteria_5'] + $alternative['kriteria_6'],
                'S-i' => $alternative['kriteria_4'],
            ];
        });

        return [
            'sum_kriteria' => $sumKriteria,
            'Total-Si' => $sumKriteria->sum('S-i'),
        ];
    }

    /**
     * 5. Determine the relative weight (Qi) of each alternative
     */
    public function relativeWeight($maximisingMinimisingIndex)
    {
        $alternatives = $maximisingMinimisingIndex['sum_kriteria'];

        $relativeWeight = $alternatives->map(function ($alternative) use ($maximisingMinimisingIndex) {
            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                '1/S-i' => 1 / $alternative['S-i'],
            ];
        });
        $total = $relativeWeight->sum('1/S-i');

        $relativeWeightTotal = $alternatives->map(function ($alternative) use ($total) {
            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                'S-i*total' => $alternative['S-i'] * round($total),
            ];
        });
        $totalSiTotal = $maximisingMinimisingIndex['Total-Si'];

        $relativeWeightTotal = $alternatives->map(function ($alternative) use ($totalSiTotal, $relativeWeightTotal) {
            $sum = $relativeWeightTotal
                ->where('id', $alternative['id'])
                ->pluck('S-i*total')
                ->sum();

            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                'Qi' => round($alternative['S+i'] + (round($totalSiTotal / round($sum,2),2)), 2),
            ];
        });

        $maxQi = $relativeWeightTotal->max('Qi');

        return [
            'relativeWeightTotal' => $relativeWeightTotal,
            'maxQi' => $maxQi,
        ];
    }

    /**
     * 6.Calculation of quantitative utility (Ui) for each alternative
     */
    public function quantitativeUtility($relativeWeight)
    {
        $alternatives = $relativeWeight['relativeWeightTotal'];

        $quantitativeUtility = $alternatives->map(function ($alternative) use ($relativeWeight) {
    
            $Ui = round(($alternative['Qi'] / $relativeWeight['maxQi']) * 100);
        
            // Simpan nilai Ui ke dalam tabel database
            \DB::table('evaluasi') 
                ->where('id', $alternative['id'])
                ->update(['hasil' => $Ui]);
    
            
            return [
                'id' => $alternative['id'],
                'id_siswa' => $alternative['id_siswa'],
                'id_periode' => $alternative['id_periode'],
                'nama_siswa' => $alternative['nama_siswa'],
                'Ui' => $Ui,
            ];
        });
    
        return $quantitativeUtility;
    }
    /**
     * 7. Ranking
     */
    public function ranking($quantitativeUtility)
    {
        // Sort the alternatives by 'Ui' property in descending order
        $sortedAlternatives = $quantitativeUtility->sortByDesc('Ui')->values()->all();

        // Initialize an array to store ranked alternatives
        $rankedAlternatives = [];

        // Iterate over sorted alternatives and assign ranks
        foreach ($sortedAlternatives as $index => $alternative) {
            $alternative['ranking'] = $index + 1; // Rank starts from 1
            $rankedAlternatives[] = $alternative;
        }

        return $rankedAlternatives;
    }
}
