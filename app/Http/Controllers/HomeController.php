<?php

namespace App\Http\Controllers;
use App\Models\User;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\SendEmailNotification;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendNotification()
    {
        $user = User::first();

        $details = [
            'greeting' => 'Hi Admin',
            'body' => 'the order of student table is reorder successfully ',
            // 'thanks' => 'Thank you for using tuto!',
            'actiontext' => 'View My Site',
            'actionurl' => url('/'),
            'lastline' => 'this last line',
            // 'order_id' => 101
        ];

        Notification::send($user, new SendEmailNotification($details));

        dd('done');
    }
}
