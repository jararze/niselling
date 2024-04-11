<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {

        $quotesCount = Quote::count();
        $modelCount = ModelOfCar::count();
        $gradeCount = Grade::count();

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

        $topSellingModels = Quote::with('modelOfCar')
            ->select('model', DB::raw('count(*) as count'))
            ->groupBy('model')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        $totalColors = VehicleColor::count();
        $lastThreeColors = VehicleColor::latest()->take(5)->get();


        $results = [];
        $results2 = [];
        $results3 = $typeContactePercentageArray;

        $topOneModel = $topSellingModels[0]->model;

        $topSellingGrades = Quote::with('gradeOfCar')
            ->select('grade', DB::raw('count(*) as count'))
            ->where('model', $topOneModel)
            ->groupBy('grade')
            ->orderBy('count', 'desc')
//            ->take(5)
            ->get();

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

        $types = Type::with(['modelType', 'modelType.grades', 'modelType.quotes'])->get();

//        dd($types);
        $typeModelGradeQuote = $types->map(function ($type) {
            $typeArray = ['type_name' => $type->name, 'type_icon' => $type->icon, 'model_of_cars_count' => $type->modelType->count(), 'grades_count' => 0, 'quotes_count' => 0];
            foreach ($type->modelType as $model) {
                $typeArray['grades_count'] += $model->grades->count();
                $typeArray['quotes_count'] += $model->quotes->count();
            }
            return $typeArray;
        });

        return view('dashboard', [
            'quotesPastMonth' => $total,
            'arrayWithDates' => $results,
            'quotesWithPayment' => $total2,
            'arrayWithPayment' => $results2,
            'arrayTypeContact' => $results3,
            'totalQuotes' => $quotesCount,
            'totalColors' => $totalColors,
            'lastThreeColors' => $lastThreeColors,
            'topSellingModels' => $topSellingModels,
            'topSellingGrades' => $topSellingGrades,
            'modelCount' => $modelCount,
            'gradeCount' => $gradeCount,
            'typeModelGradeQuote' => $typeModelGradeQuote,
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
