<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $quotesCount = Quote::count();
        $lastMonth = Carbon::now()->subDays(15);

        $quotesPastMonth = Quote::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $lastMonth)
            ->groupBy('date')
            ->get();

        $quotesWithPayment = Quote::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $lastMonth)
            ->whereNotNull('way_to_pay')
            ->groupBy('date')
            ->get();

        $typeContactePercentage = Quote::select('type_contact', DB::raw('COUNT(*)  / (select COUNT(*) from quotes) as percentage'))
            ->groupBy('type_contact')
            ->get();

        $typeContactePercentageArray = $typeContactePercentage->mapWithKeys(function ($item) {
            $key = $item['type_contact'] ?? 'null';
            return [$key => $item['percentage']];
        })->toArray();

        $totalColors = VehicleColor::count();
        $lastThreeColors = VehicleColor::latest()->take(5)->get();


        $results = [];
        $results2 = [];
        $results3 = $typeContactePercentageArray;

        $startDate = Carbon::now()->startOfMonth()->subDays(15);
        $endDate = Carbon::now();

        while ($startDate->lte($endDate)) {
            $dateFormatted = $startDate->format('Y-m-d');

            $match = $quotesPastMonth->firstWhere('date', $dateFormatted);
            $match2 = $quotesWithPayment->firstWhere('date', $dateFormatted);

            $results[$dateFormatted] = $match->count ?? 0;
            $results2[$dateFormatted] = $match2->count ?? 0;

            $startDate->addDay();
        }

        $total = array_sum($results);
        $total2 = array_sum($results2);



        return view('dashboard', [
            'quotesPastMonth' => $total,
            'arrayWithDates' => $results,
            'quotesWithPayment' => $total2,
            'arrayWithPayment' => $results2,
            'arrayTypeContact' => $results3,
            'totalQuotes' => $quotesCount,
            'totalColors' => $totalColors,
            'lastThreeColors' => $lastThreeColors,
        ]);

//        $showrooms = Showroom::where('status', 1)
//            ->orderBy('name', 'ASC')
//            ->get();
//
//        $agents = Agent::where('status', 1)
//            ->orderBy('name', 'ASC')
//            ->get();
//
//
//        return view('backend.configuration.agent.index', [
//            'showrooms' => $showrooms,
//            'agents' => $agents,
//        ]);


    }
}
