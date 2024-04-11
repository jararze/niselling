<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $typeContacts = ['whatsapp', 'phone', 'online'];
        $statuses = ['pendiente'];
        $ext = ['LP', 'CB', 'SC'];

        $hexCodes = DB::table('vehicle_colors')->pluck('color_code')->toArray();

        for ($i = 0; $i < 5000; $i++) {

            $showroom = $faker->numberBetween(1, 14);

            $agentCount = DB::table('agents')->where('showroom_id', $showroom)->count();

            if ($agentCount === 0) {
                continue;
            }
            $agent = $faker->numberBetween(1, $agentCount);

            $date = $faker->dateTimeBetween(Carbon::now()->startOfYear()->toDateString(), Carbon::today()->toDateString());

            $typeContactSelected = $faker->randomElement($typeContacts);
            $wayToPay = null;
            if ($typeContactSelected === 'online') {
                $paymentMethods = ['transferencia_bancaria', 'online_libelula'];
                $wayToPay = $faker->randomElement($paymentMethods);
            }

            $model = $faker->numberBetween(1, 13);
            $preGrade = DB::table('grades')->where('model_of_cars_id', $model)->count();

            if ($preGrade === 0) {
                continue;
            }
            $grade = $faker->numberBetween(1, $preGrade);

            DB::table('quotes')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'model' => $model,
                'grade' => $grade,
                'phone' => $faker->randomNumber(8),
                'email' => $faker->email,
                'city' => $faker->numberBetween(1, 11),
                'dni' => $faker->randomNumber(8),
                'ext' => $faker->randomElement($ext),
                'color' => $faker->randomElement($hexCodes),
                'test_drive' => $faker->boolean,
                'showroom' => $showroom,
                'agent_id' => $agent,
                'type_contact' => $faker->randomElement($typeContacts),
                'way_to_pay' => $wayToPay,
                'status' => $faker->randomElement($statuses),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
