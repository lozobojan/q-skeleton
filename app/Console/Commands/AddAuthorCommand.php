<?php

namespace App\Console\Commands;

use App\Services\RemoteEntities\AuthorService;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class AddAuthorCommand extends Command
{

    private AuthorService $authorService;

    #[Pure]
    public function __construct()
    {
        parent::__construct();
        $this->authorService = new AuthorService();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CLI command used for saving author details to remote API';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $authorData = $this->getInputs();
        $this->info('Processing...');

        $this->authorService->save($authorData);

        $this->info('Author saved successfully!');
        return 0;
    }

    /**
     * Get author data from user input
     * @return array
     */
    #[ArrayShape(['first_name' => "mixed", 'last_name' => "mixed", 'birthday' => "mixed", 'biography' => "mixed", 'gender' => "array|string", 'place_of_birth' => "mixed"])]
    private function getInputs(): array{
        return [
            'first_name' => $this->ask("First name: "),
            'last_name' => $this->ask("Last name: "),
            'birthday' => $this->ask("Birthday (d.m.Y): "),
            'biography' => $this->ask("Biography: "),
            'gender' => $this->choice("Gender: ", ["male", "female"]),
            'place_of_birth' => $this->ask("Place of birth: ")
        ];
    }
}
