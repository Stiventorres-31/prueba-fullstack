<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\text;
class CreateVisit extends Command
{
    /**
     * 10.955961-74.7799936
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visit:create';

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
        $name = text(
            label:'Enter the name of the visit',
            placeholder:'Stiven Torres',
            validate:['name' =>'required|max:255']
        );
        $email = text(
            label:'Enter the email of the visit',
            placeholder:'stiventorres@example.com',
            validate:['email' =>'required|max:255|email']
        );
        $latitude = text(
            label:'Enter the latitude of the visit',
            placeholder:'10.955961',
            validate:['latitude' =>'required|numeric|between:-90,90']
        );
        $longitude = text(
            label:'Enter the longitude of the visit',
            placeholder:'-74.7799936',
            validate:['longitude' =>'required|numeric|between:-180,180']
        );
        $identification = text(
            label:'Enter the identification of the user',
            placeholder:'123456789',
            validate:['identification' =>'required|max:255']
        );


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
