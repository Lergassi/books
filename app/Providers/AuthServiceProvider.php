<?php

namespace App\Providers;

use App\Book;
use App\Node;
use App\NodeItem;
use App\Policies\BookPolicy;
use App\Policies\NodeItemPolicy;
use App\Policies\NodePolicy;
use App\Policies\ReadPolicy;
use App\Read;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Book::class => BookPolicy::class,
        Node::class => NodePolicy::class,
        NodeItem::class => NodeItemPolicy::class,
        Read::class => ReadPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //TODO: Почему не работает?
        Gate::define('book.index', 'BookPolicy@index');
    }
}
