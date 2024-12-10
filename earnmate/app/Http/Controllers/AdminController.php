<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Deposit;
use App\Models\DoneTask;
use App\Models\Level;
use App\Models\Offer;
use App\Models\OfferSubscription;
use App\Models\Reference;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        $admins = Admin::all()->take(6);
        $admins->load('user');
        $levels = Level::all();
        foreach ($levels as $level) {
            $level->users_count = $level->subscriptions()->where('completed', false)->count();
        }
        $users_count = User::all()->count();
        $users_today = User::where('created_at', '=', Carbon::today())->count();
        $invitations_count = Reference::all()->count();
        $invitations_today = Reference::whereDate('created_at', '=', Carbon::today())->count();
        $deposits_sum = $admin->deposits()->where('status', 'confirmed')->sum('amount');
        $today_deposits_sum = Deposit::whereDate('created_at', '=', Carbon::today())->sum('amount');
        $withdrawals_sum = $admin->withdrawals()->where('status', 'completed')->sum('amount');
        $today_withdrawals_sum = Withdrawal::whereDate('created_at', '=', Carbon::today())->sum('amount');
        $users_by_methods = Deposit::select('method', DB::raw('COUNT(DISTINCT user_id) as user_count'))
            ->groupBy('method')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'admin' => $admin,
            'admins' => $admins,
            'levels' => $levels,
            'users_count' => $users_count,
            'users_today' => $users_today,
            'invitations_count' => $invitations_count,
            'invitations_today' => $invitations_today,
            'deposits_sum' => $deposits_sum,
            'today_deposits_sum' => $today_deposits_sum,
            'withdrawals_sum' => $withdrawals_sum,
            'today_withdrawals_sum' => $today_withdrawals_sum,
            'users_by_method' => $users_by_methods,
        ]);
    }

    public function schedule_offs(Request $request)
    {
        $offers = OfferSubscription::where('done', false)->where('status','confirmed')->get();
        foreach ($offers as $offer) {
            $level_days = $offer->offer->days;
            if ($offer->created_at == Carbon::now()->subDays($level_days)) {
                $offer->update([
                    'done' => true
                ]);
                $user = $offer->user;
                $user->update([
                    'balance' => $user->balance + $offer->offer->amount + $offer->offer->amount*$offer->offer->percentage/100
                ]);
            }
        }
        return response()->json($offers->count());
    }
    public function schedule_subs(Request $request)
     {
        $subscriptions = Subscription::where('completed', false)
        ->whereDate('created_at', Carbon::now()->subDays(5))
        ->get();
        foreach ($subscriptions as $subscription) {
            $startDate = Carbon::now()->subDays(5);
            $userTasks = DoneTask::where('user_id',$subscription->user_id)->where(function ($query) use ($startDate){
                $query->whereDate('created_at','>=',$startDate)
                        ->whereDate('created_at','<=',Carbon::today());
            })->get();
            $activeTasks = $userTasks->count() - $userTasks->where('status','confirmed')->count();
            if ($activeTasks < 5) {
                $subscription->update([
                    'completed' => true
                ]);
                $user = $subscription->user;
                $user->update([
                    'balance' => $user->balance + $subscription->level->reward
                ]);
            }else {
                $subscription->update([
                    'completed' => true
                ]);
            }
        }
        return response()->json( $subscriptions->count());
    }
    public function profile(Request $request)
    {
        return Inertia::render('Admin/Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function deposits()
    {
        $deposits = Deposit::where('admin_id', Admin::where('user_id', Auth::user()->id)->first()->id)->orderBy('created_at')->get();
        $deposits->load('user');
        return Inertia::render('Admin/Deposits', ['deposits' => $deposits]);
    }

    public function withdrawals()
    {
        return Inertia::render('Admin/Withdrawals');

    }

    public function tasks()
    {
        return Inertia::render('Admin/Tasks');

    }

    public function offers()
    {
        $offers = Offer::all();

        return Inertia::render('Admin/Offers', [
            'offers' => $offers,
        ]);

    }

    public function messages()
    {
        
        return Inertia::render('Admin/Messages');

    }

    public function leaderboard()
    {
        return Inertia::render('Admin/LeaderBoard');
    }

    public function admins()
    {
        $admins = Admin::all()->load('user');

        return Inertia::render('Admin/Admins', ['admins' => $admins]);
    }

    public function users()
    {
        $users = User::with(['tasks', 'friends', 'bonuses', 'subscriptions'])->get();

        return Inertia::render('Admin/Users', ['users' => $users]);
    }

    public function show($id)
    {
        if (Admin::where('user_id', $id)->exists()) {
            return Inertia::render('Admin/Show', ['admin' => User::find($id)->load('admin')]);
        }
    }

    public function done_tasks()
    {
        $tasks = Auth::user()->admin->done_tasks->load(['task', 'user']);

        return Inertia::render('Admin/DoneTasks', ['tasks' => $tasks]);
    }

    public function add(Request $request)
    {
        $email = $request->email;
        $RIP = $request->RIP;
        $user_id = User::where('email', $email)->first()->id;
        $admin = Admin::create([
            'user_id' => $user_id,
            'RIP' => $RIP,
            'balance' => 0.00,
        ]);
        $admin->load('user');

        return response()->json($admin);
    }

    public function user($id)
    {
        $user = User::find($id)->load(['withdrawals', 'subscriptions', 'deposits', 'tasks', 'friends', 'bonuses', 'offers']);
        $tasks = $user->tasks()->count();
        $bonus = $user->bonuses()->sum('amount');
        $offers = $user->offers;
        $offer_gain =0;
        foreach ($offers as $offer) {
            $offer_gain = $offer_gain + $offer->offer->amount+$offer->offer->percentage;
        }
        return Inertia::render('Admin/User', [
            'user' => $user,
            'offers' => $offer_gain,
            'bonus' => $bonus,
            'tasks'=> $tasks
        ]);
    }

    public function getMoneyChartData()
    {

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            $deposits = $this->fetchGroupedData(Deposit::class, 'confirmed', $startDate, $endDate);
            $withdrawals = $this->fetchGroupedData(Withdrawal::class, 'completed', $startDate, $endDate);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Unable to fetch data'], 500);
        }

        $dates = collect(range(0, $startDate->diffInDays($endDate)))
            ->map(fn ($day) => $startDate->copy()->addDays($day)->format('Y-m-d'));

        $depositsData = $this->mapDataToDates($dates, $deposits);
        $withdrawalsData = $this->mapDataToDates($dates, $withdrawals);

        return response()->json([
            'dates' => $dates->values(),
            'deposits' => $depositsData->values(),
            'withdrawals' => $withdrawalsData->values(),
        ]);
    }

    private function fetchGroupedData(string $modelClass, string $status, Carbon $startDate, Carbon $endDate)
    {
        return $modelClass::where('status', $status)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function mapDataToDates($dates, $data)
    {
        return $dates->map(function ($date) use ($data) {
            return optional($data->firstWhere('date', $date))->total ?? 0;
        });
    }
}
