<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function test_unauthenticated_users_may_not_add_replies()
    {
//        $this->expectException('Illuminate\Auth\AuthenticationException');

//        $thread = factory('App\Thread')->create();

//        $reply = factory('App\Reply')->create();
//        $this->post(thread->path(). '/replies', $reply->toArray());
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    function test_an_authenticated_user_may_participate_in_forum_threads()
    {
//        $user = factory('App\User')->create();
//        $this->be($user = factory('App\User')->create());
//
//        $thread = factory('App\Thread')->create();
//        $reply = factory('App\Reply')->make();
//        $this->post(thread->path(). '/replies', $reply->toArray());
//
//        $this->get($this->thread->path())
//            ->assertSee($reply->body);
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path(). '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);

    }
}
