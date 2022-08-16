<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Notification::class;

    public function definition() {
        return [
            'user_id'         => 1,
            'status'          => Notification::UN_READ,
            'notifiable_id'   => rand(1, 5),
            'notifiable_type' => User::class,
        ];
    }
}
