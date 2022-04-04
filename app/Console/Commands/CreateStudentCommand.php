<?php

namespace App\Console\Commands;
use App\Models\Student;
use App\Models\School;
use App\Models\User;
use Illuminate\Console\Command;
use DB;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
class CreateStudentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reorder:student {schoolid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorder Students by school id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
     // $school_id=$this->ask('school_id');
     $school_id = $this->argument('schoolid');

      $studentsIds = DB::table("students")->select("id")->where("school_id","=",$school_id)->get()->toArray();

      $i=1;
      foreach ($studentsIds as  $ids) {

          $student2 = Student::find($ids->id);
          $student2->order = $i++;
          $student2->save();
      }
      return $this->sendNotification();
      echo 'succeffully reorderd school '.$school_id;

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

        echo 'Succeffully reorderd school_id ';
    }
}
