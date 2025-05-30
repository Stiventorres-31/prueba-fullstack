<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;
class CreateVisit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-visit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new visit using Laravel Prompts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = text('Enter the name of the visit');
        $email = text('Enter the email of the visit');
        $latitude = text('Enter the latitude of the visit');
        $longitude = text('Enter the longitude of the visit');
        $identification = text('Enter the identification of the user');


        $user = User::where('identification', $identification)->first();

        if (!$user) {
            $this->error('User with the given identification not found.');
            return Command::FAILURE;
        }

        Visit::create([
            'name' => $name,
            'email' => $email,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'user_id' => $user->id,
        ]);
        $this->info('Visit created successfully.');
        return Command::SUCCESS;
    }
}
