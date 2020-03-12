

# Sintex Account Management Synchronization 
Laravel Sintex Account Management Synchronization Library

## Installation
    composer require sintexph/account-synchronization

## Publish Configuration
This will publish the configuration named "account-sync.php"

    php artisan vendor:publish --provider="AccountSynchronization\AccountSynchronizationProvider"

## Default Field Mapping

    'map' => [
        'id_number'=>'id_number',
        
        'first_name'=>'first_name', 
        'middle_name'=>'middle_name', 
        'last_name'=>'last_name', 
        'full_name'=>null,
        
        'contact'=>'contact', 
        'email'=>'email', 
        'position'=>'position', 
        'section'=>'section', 
        'department'=>'department', 
        'factory'=>'factory', 
        
        'username'=>'username', 
        'password'=>'password', 
        
        'active'=>null,
    ],

## Extra Field Mapping
Extra fields to map when there are fields that was not exists on the default fields

    'extra'=>[
        'demo_field1'=>'field1',
        'demo_field2'=>'field2',
    ],

## Command to sync
    php artisan accounts:sync

## Set Schedule for automatic sync
    $schedule->command('accounts:sync')->everyMinute()->withoutOverlapping(10)->runInBackground(); 

## Set Schedule for automatic cleaning
    $schedule->command('accounts:clean')->dailyAt('23:00')->withoutOverlapping(10)->runInBackground();


