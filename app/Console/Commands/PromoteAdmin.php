<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * There's no self-serve "create the first admin" UI by design -- flagging
 * is_admin is a one-time, deliberately manual bootstrap step. Run on the
 * server as: php artisan admin:promote someone@example.com
 */
class PromoteAdmin extends Command
{
    protected $signature = 'admin:promote {email}';

    protected $description = 'Grant admin panel access to an existing user by email';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error("No user found with email '{$this->argument('email')}'. They need to register an account first.");

            return self::FAILURE;
        }

        $user->forceFill(['is_admin' => true])->save();
        $this->info("{$user->name} ({$user->email}) can now access /admin.");

        return self::SUCCESS;
    }
}
