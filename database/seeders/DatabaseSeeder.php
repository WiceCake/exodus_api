<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Job;
use App\Models\Employee;
use App\Models\Applicant;
use App\Models\EmployeeRole;
use Illuminate\Database\Seeder;
use App\Models\ApplicantDocument;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Applicant::insert([
            [
                'first_name' => 'John',
                'middle_name' => 'Michael',
                'last_name' => 'Smith',
                'email' => 'john.smith20@gmail.com',
                'birthday' => '1990-05-15',
                'gender' => 'Male',
                'status' => 'Accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Sarah',
                'middle_name' => null,
                'last_name' => 'Johnson',
                'email' => 'johnson.sarah@hotmail.com',
                'birthday' => '1988-09-20',
                'gender' => 'Female',
                'status' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'David',
                'middle_name' => 'Alexander',
                'last_name' => 'Lee',
                'email' => 'leedavid@yahoo.com',
                'birthday' => '1995-12-08',
                'gender' => 'Male',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Emily',
                'middle_name' => 'Marie',
                'last_name' => 'Brown',
                'email' => 'emily.brown92@gmail.com',
                'birthday' => '1992-07-25',
                'gender' => 'Female',
                'status' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Michael',
                'middle_name' => null,
                'last_name' => 'Williams',
                'email' => ' michael.williams91@gmail.com',
                'birthday' => '1991-03-12',
                'gender' => 'Male',
                'status' => 'Accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Emma',
                'middle_name' => 'Jane',
                'last_name' => 'Carter',
                'email' => 'emma.carter@gmail.com',
                'birthday' => '1993-11-18',
                'gender' => 'Female',
                'status' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Matthew',
                'middle_name' => 'Thomas',
                'last_name' => 'Taylor',
                'email' => 'matthewzzz@hotmail.com',
                'birthday' => '1989-06-30',
                'gender' => 'Female',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Olivia',
                'middle_name' => null,
                'last_name' => 'Martinez',
                'email' => ' martinez.christopher96@gmail.com',
                'birthday' => '1996-02-28',
                'gender' => 'Male',
                'status' => 'Accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Christopher',
                'middle_name' => null,
                'last_name' => 'Martinez',
                'email' => 'martinez.christopher96@gmail.com',
                'birthday' => '1996-02-28',
                'gender' => 'Male',
                'status' => 'Accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Sophia',
                'middle_name' => 'Grace',
                'last_name' => 'Clark',
                'email' => 'sophia.clark97@yahoo.com',
                'birthday' => '1997-10-10',
                'gender' => 'Female',
                'status' => 'Accepted',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        ApplicantDocument::insert([
            [
                'applicant_id' => 1,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 1,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 1,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 1,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 2,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 2,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 3,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 4,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 4,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 4,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 5,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 6,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 6,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 7,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 7,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 7,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 8,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 9,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 10,
                'file_category' => 'Valid ID',
                'path' => 'valid_id.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 10,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 10,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 10,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 9,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 9,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 9,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 5,
                'file_category' => 'Birth Certificate',
                'path' => 'birth_certificate.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 5,
                'file_category' => 'Barangay Clearance',
                'path' => 'brgy_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 5,
                'file_category' => 'Police Clearance',
                'path' => 'police_clearance.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        Job::insert([
            [
                'job_name' => 'CEO',
                'slots' => 0,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Secretary',
                'slots' => 0,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Manager',
                'slots' => 4,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Senior Developer',
                'slots' => 50,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Junior Developer',
                'slots' => 99,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Data Analyst',
                'slots' => 120,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Data Engineer',
                'slots' => 80,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'job_name' => 'Software Engineer',
                'slots' => 30,
                'description' => fake()->paragraph(200),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        Employee::insert([
            [
                'applicant_id' => 1,
                'username' => 'john.smith',
                'password' => bcrypt('johnsmith123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 10,
                'username' => 'sophia.graceee',
                'password' => bcrypt('grace123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 5,
                'username' => 'michaellers',
                'password' => bcrypt('michael123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'applicant_id' => 9,
                'username' => 'tope.martiz',
                'password' => bcrypt('tope123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        EmployeeRole::insert([
            [
                'employee_id' => 1,
                'job_id' => 1
            ],
            [
                'employee_id' => 2,
                'job_id' => 2
            ],
            [
                'employee_id' => 3,
                'job_id' => 3
            ],
            [
                'employee_id' => 4,
                'job_id' => 5
            ],
        ]);

        Schedule::insert([
            [
                'employee_id' => 1,
                'day' => 'Monday',
                'time_slot_start' => '9:00:00',
                'time_slot_end' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'day' => 'Tuesday',
                'time_slot_start' => '9:00:00',
                'time_slot_end' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'day' => 'Wednesday',
                'time_slot_start' => '9:00:00',
                'time_slot_end' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'day' => 'Thursday',
                'time_slot_start' => '9:00:00',
                'time_slot_end' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'day' => 'Friday',
                'time_slot_start' => '9:00:00',
                'time_slot_end' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'day' => 'Monday',
                'time_slot_start' => '8:30:00',            
                'time_slot_end' => '21:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'day' => 'Tuesday',
                'time_slot_start' => '8:30:00',
                'time_slot_end' => '21:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'day' => 'Wednesday',
                'time_slot_start' => '8:30:00',
                'time_slot_end' => '21:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'day' => 'Thursday',
                'time_slot_start' => '8:30:00',
                'time_slot_end' => '21:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'day' => 'Friday',
                'time_slot_start' => '8:30:00',
                'time_slot_end' => '21:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'day' => 'Monday',
                'time_slot_start' => '7:30:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'day' => 'Wednesday',
                'time_slot_start' => '7:30:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'day' => 'Friday',
                'time_slot_start' => '7:30:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'day' => 'Tuesday',
                'time_slot_start' => '8:00:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'day' => 'Thursday',
                'time_slot_start' => '8:00:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'day' => 'Friday',
                'time_slot_start' => '8:00:00',
                'time_slot_end' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
