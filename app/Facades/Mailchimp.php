<?php
namespace App\Facades;

use App\Services\MailchimpService;
use Illuminate\Support\Facades\Facade;


/**
 * @method static array subscribe(string $email, string $fullName)
 * @method static array updateSubscriber(string $email, string $fullName)
*/
class Mailchimp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MailchimpService::class;
    }
}
