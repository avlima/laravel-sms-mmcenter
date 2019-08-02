[![Packagist](https://img.shields.io/packagist/v/avlima/laravel-sms-mmcenter.svg)](https://packagist.org/packages/avlima/laravel-sms-mmcenter) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/avlima/laravel-sms-mmcenter/master/LICENSE)

# Integrate SMS MMCenter with Laravel
MMCenter SMS notification service for Laravel.

#### [Star ⭐](https://github.com/avlima/laravel-sms-mmcenter) repo to show suport 😊

## Installation

### Install Package
Require this package with composer:
```
composer require avlima/laravel-sms-mmcenter
```
### Add Service Provider & Facade

#### For Laravel 5.5+
Once the package is added, the service provider and facade will be autodiscovered.

#### For Older versions of Laravel
Add the ServiceProvider to the providers array in `config/app.php`:
```
Avlima\SmsMMCenter\Providers\SmsMMCenterServiceProvider::class,
```

Add the Facade to the aliases array in `config/app.php`:
```
'SmsMMCenter': Avlima\SmsMMCenter\Facades\SmsMMCenterFacade::class,
```

### Publish Config
Once done, publish the config to your config folder using:
```
php artisan vendor:publish --provider="Avlima\SmsMMCenter\Providers\SmsMMCenterServiceProvider"
```

## Configuration
Once the config file is published, open `config/sms-mmcenter.php`

## Usage

#### Using SmsMMCenter facade
- Basic Usage `SmsMMCenter::sendMessage("TO","MESSAGE");`

### Use in Notifications

#### Setting up the Route for Notification
Add the method `routeNotificationForSmsMMCenter()` to your Notifiable model:
```
public function routeNotificationForSmsMMCenter() {
        return $this->phone; //Name of the field to be used as mobile
    }    
```

By default, your User model uses Notifiable.

#### Setting up Notification

Add 

`use Avlima\SmsMMCenter\Notifications\SmsMMCenterChannel;`

and 

`use Avlima\SmsMMCenter\Notifications\SmsMMCenterMessage;`

to your notification. 

You can create a new notification with `php artisan make:notification NOTIFICATION_NAME`

In the `via` function inside your notification, add `return [SmsMMCenterChannel::class];` and add a new function `toSmsMMCenter($notifiable)` to return the message body and parameters.

Notification example:-
```
namespace App\Notifications;

use Avlima\SmsMMCenter\Notifications\SmsMMCenterChannel;
use Avlima\SmsMMCenter\Notifications\SmsMMCenterMessage;
use Illuminate\Notifications\Notification;

class ExampleNotification extends Notification
{
    public function via($notifiable)
    {
        return [SmsMMCenterChannel::class];
    }
    
    public function toSmsMMCenter($notifiable)
    {
        return (new SmsMMCenterMessage)
            ->to("44999999999")
            ->content("Hello");
    }
}
```
## Support
Feel free to post your issues in the issues section.

## Credits
Developed by [Alberto Lima](https://github.com/avlima "Alberto Vieira de Lima")

## License
MIT
