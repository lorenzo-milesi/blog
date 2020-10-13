<?php

declare(strict_types = 1);

namespace App\Tests\Unit;

use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    /** @test */
    public function it_can_manage_an_email(): void
    {
        $value = 'test@test.fr';
        $setEmailResponse = $this->user->setEmail($value);
        self::assertInstanceOf(User::class, $setEmailResponse);
        self::assertEquals($value, $this->user->getEmail());
        self::assertEquals($value, $this->user->getUsername());
    }

    /** @test */
    public function it_has_roles(): void
    {
        $value = ['ROLE_ADMIN'];
        $setRolesResponse = $this->user->setRoles($value);
        self::assertInstanceOf(User::class, $setRolesResponse);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    /** @test */
    public function it_has_password(): void
    {
        $value = 'password';
        $setPasswordResponse = $this->user->setPassword($value);
        self::assertInstanceOf(User::class, $setPasswordResponse);
        self::assertEquals($value, $this->user->getPassword());
    }

    /** @test */
    public function it_can_manage_posts(): void
    {
        $value = new Post();
        self::assertInstanceOf(User::class, $this->user->addPost($value));
        self::assertCount(1, $this->user->getPosts());
        self::assertInstanceOf(Post::class, $this->user->getPosts()[0]);
        self::assertTrue($this->user->getPosts()->contains($value));
    }
}