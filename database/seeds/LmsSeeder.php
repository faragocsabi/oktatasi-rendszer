<?php

use App\User;
use App\Teacher;
use App\Student;
use App\Subject;
use App\Task;
use App\Solution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Delete tables
        DB::table('users')->delete();
        DB::table('teachers')->delete();
        DB::table('students')->delete();
        DB::table('subjects')->delete();
        DB::table('student_subject')->delete();
        DB::table('tasks')->delete();
        DB::table('solutions')->delete();


        // Teacher1
        $user1 = User::create([
            'name' => 'Teacher1',
            'email' => 'teacher1@gmail.com',
            'password' => Hash::make('strongpwd'),
            'is_teacher' => '1',
        ]);
        $teacher1 = new Teacher();
        $teacher1->name = $user1['name'];
        $teacher1->email = $user1['email'];
        $user1->teacher()->save($teacher1);
        
        // Teacher2
        $user2 = User::create([
            'name' => 'Teacher2',
            'email' => 'teacher2@gmail.com',
            'password' => Hash::make('strongpwd'),
            'is_teacher' => '1',
        ]);
        $teacher2 = new Teacher();
        $teacher2->name = $user2['name'];
        $teacher2->email = $user2['email'];
        $user2->teacher()->save($teacher2);
        
        // Student1
        $user3 = User::create([
            'name' => 'Student1',
            'email' => 'student1@gmail.com',
            'password' => Hash::make('strongpwd'),
            'is_teacher' => '0',
        ]);
        $student1 = new Student();
        $student1->name = $user3['name'];
        $student1->email = $user3['email'];
        $user3->student()->save($student1);
        
        // Student2
        $user4 = User::create([
            'name' => 'Student2',
            'email' => 'student2@gmail.com',
            'password' => Hash::make('strongpwd'),
            'is_teacher' => '0',
        ]);
        $student2 = new Student();
        $student2->name = $user4['name'];
        $student2->email = $user4['email'];
        $user4->student()->save($student2);
        
        // Subject1
        $subject1 = Subject::create([
            'name' => 'Subject1',
            'teacher_id' => '1',
            'description' => 'Lorem ipsum1',
            'code' => 'IK-EXP123',
            'credit' => '5',
            'public' => '1',
        ]);
        
        // Subject2
        $subject2 = Subject::create([
            'name' => 'Subject2',
            'teacher_id' => '2',
            'description' => 'Lorem ipsum2',
            'code' => 'IK-EXP321',
            'credit' => '10',
            'public' => '1',
        ]);

        // Task1
        $task1 = Task::create([
            'name' => 'Task1',
            'description' => 'Lorem ipsum1',
            'points' => 1,
            'start_date' => '2020-06-04T12:21',
            'end_date' => '2020-06-15T12:21',
            'subject_id' => 1
        ]);
        
        // Task2
        $task2 = Task::create([
            'name' => 'Task2',
            'description' => 'Lorem ipsum2',
            'points' => 2,
            'start_date' => '2020-06-04T12:21',
            'end_date' => '2020-06-15T12:21',
            'subject_id' => 2
        ]);

        // Solution1
        $solution1 = Solution::create([
            'solution' => 'solution1',
            'grade' => 1,
            'gradetext' => 'gradetext1',
            'checked' => true,
            'checked_at' => '2020-06-07 19:15:38',
            'uploaded_at' => '2020-06-07 19:07:38',
            'student_id' => 1,
            'task_id' => 1
        ]);
        
        // Solution2
        $solution2 = Solution::create([
            'solution' => 'solution2',
            'uploaded_at' => '2020-06-07 19:07:38',
            'student_id' => 2,
            'task_id' => 2
        ]);
    }
}