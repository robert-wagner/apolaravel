<?php

use Illuminate\Support\Facades\Auth;
use APOSite\Models\Users\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    use DatabaseMigrations;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function buildWebmasterUser() {
        $webmaster = $this->buildUser("webmaster", "Web", "Master");

        // Do the thing to make this user a webmaster.

        return $webmaster;
    }

    public function buildUser($id, $first_name, $last_name) {
        $user = new User();
        $user->id = $id;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->save();
        return $user;
    }

    public function buildFakerUser($id, $first_name, $lastName) {
        return factory(User::class)->make([
                                              'id'         => $id,
                                              'first_name' => $first_name,
                                              'last_name'  => $lastName,
                                          ]);
    }

    public function signInAs($id){
        Auth::once(['id'=>$id, 'password'=>'']);
        $this->assertTrue(Auth::check());
    }

    // This is used to simulate the requests that users actually do.
    // Eventually this is where we would add in OAuth token headers.
    public function callAPIMethod($method, $uri, $data, $as=null){

    }
}
