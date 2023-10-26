<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Media;
use App\Models\Detail;
use App\Models\Account;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Transfer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = collect()->merge(User::factory()->count(1)->sequence(fn() => ['is_admin' => 'Y'])->create())
                          ->merge(User::factory()->count(3)->sequence(fn() => ['is_admin' => 'N'])->create());

        $accounts = Account::factory()->count(4)->create();

        $categories = collect()->merge(Category::factory()->count(2)->sequence(fn() => ['activity_type' => 'income'])->create())
                               ->merge(Category::factory()->count(4)->sequence(fn() => ['activity_type' => 'expense'])->create());

        $accounts->each(function ($account) use ($users, $categories) {
            Activity::factory()->sequence(fn () => [
                'user_id' => $users->random()->id,
                'activity_date' => now()->subMonth(36)->startOfMonth(),
                'account_id' => $account->id,
                'category_id' => $categories->where('activity_type', 'income')->random()->id,
                'debit' => fake()->numberBetween(301, 523) * 10000,
                'credit' => 0,
            ])->create();
        });

        $date_times = array_map(fn () => fake()->dateTimeBetween('-36 months'), range(1, 2000));
        sort($date_times);

        foreach ($date_times as $date_time) {

            if (fake()->randomElement([false, false, false, false, true, false])) {
                Activity::factory()->sequence(fn () => [
                    'user_id' => $users->random()->id,
                    'activity_date' => $date_time,
                    'account_id' => $accounts->random()->id,
                    'category_id' => $categories->where('activity_type', 'income')->random()->id,
                    'debit' => fake()->numberBetween(50, 70) * fake()->randomElement([5000, 10000]),
                    'credit' => 0,
                ])->create();
            }

            if (fake()->randomElement([true, true, true, true, false, true, true, true])) {
                try {
                    Activity::factory()->sequence(fn () => [
                        'user_id' => $users->random()->id,
                        'activity_date' => $date_time,
                        'account_id' => $accounts->random()->id,
                        'category_id' => $categories->where('activity_type', 'expense')->random()->id,
                        'debit' => 0,
                        'credit' => fake()->numberBetween(1, 20) * fake()->randomElement([5000, 7500, 10000]),
                    ])->create();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            if (fake()->randomElement([true, false, false, false, false, false, false, false, false, false, false])) {
                try {
                    $from_id = $accounts->random()->id;
                    $to_id = $accounts->where('id', '!=', $from_id)->random()->id;

                    Transfer::factory()->sequence(fn () => [
                        'user_id' => $users->random()->id,
                        'from_id' => $from_id,
                        'to_id' => $to_id,
                        'transfer_date' => $date_time
                    ])->create();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }

        Activity::selectRaw('id, ABS(debit - credit) AS amount')
            ->inRandomOrder()
            ->limit(200)
            ->get()
            ->sortBy('id')
            ->each(function ($activity) {
                $count = fake()->randomElement([2, 4, 5, 7, 8]);
                $amount = $activity->amount / $count;

                Detail::factory()->count($count)->sequence(fn () => [
                    'activity_id' => $activity->id,
                    'amount' => $amount,
                ])->create();
            });

        Activity::inRandomOrder()
            ->limit(200)
            ->select('id')
            ->get()
            ->sortBy('id')
            ->each(fn ($activity) => Media::factory()->for($activity)->create());
    }
}
