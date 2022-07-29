## Running the project in a local dev environment

The app local dev environment uses Laravel Sail. 
That means that Docker needs to be installed in order to run the app locally. This is the only prerequisite.

After cloning the repository, navigate to the root project folder in a terminal and run:
    
    cp .env.example .env
    ./vendor/bin/sail up
