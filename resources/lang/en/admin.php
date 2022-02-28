<?php

return [
    'auth_global' => [
        'email' => 'Your Email',
        'password' => 'Password',
        'password_confirm' => 'Password confirmation',
        'employee_number' => 'Your e-employee Number',

    ],

    'login' => [
        'title' => 'Login',
        'sign_in_text' => 'Sign In to your account',
        'button' => 'Login',
        'forgot_password' => 'Forgot password?',
    ],

    'password_reset' => [
        'title' => 'Reset Password',
        'note' => 'Reset forgotten password',
        'button' => 'Reset password',
    ],

    'forgot_password' => [
        'title' => 'Reset Password',
        'note' => 'Send password reset e-mail',
        'button' => 'Send Password Reset Link',
    ],

    'activation_form' => [
        'title' => 'Activate account',
        'note' => 'Send activation link to e-mail',
        'button' => 'Send Activation Link',
    ],

    'activations' => [
        'sent' => 'We have sent you an activation link!',
        'activated' => 'Your account was activated!',
        'invalid_request' => 'The request failed.',
        'disabled' => 'Activation is disabled.',
    ],

    'passwords' => [
        'reset' => 'Your password has been reset!',
        'sent' => 'We have sent you a password reset link!',
        'invalid_password' => 'Password must be at least six characters long and match the confirmation.',
        'invalid_token' => 'The password reset token is invalid.',
        'invalid_user' => "We can't find a user with this e-mail address.",
    ],

    'profile_dropdown' => [
        'profile' => 'Profile',
        'password' => 'Password',
        'logout' => 'Logout',
    ],
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'employee_number' => 'Employee Number',

            //Belongs to many relations
            'roles' => 'Roles',

        ],
    ],

    'restaurant-table' => [
        'title' => 'Restaurant Tables',

        'actions' => [
            'index' => 'Restaurant Tables',
            'create' => 'New Restaurant Table',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'number_of_seats' => 'Number of seats',
            'table_number' => 'Table number',

        ],
    ],

    'restaurant-table-reservation' => [
        'title' => 'Restaurant Table Reservations',

        'actions' => [
            'index' => 'Restaurant Table Reservations',
            'create' => 'New Restaurant Table Reservation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'reservation_date' => 'Reservation date',
            'reservation_start_time' => 'Reservation start time',
            'reservation_end_time' => 'Reservation end time',
            'created_by' => 'Created by',
            'restaurant_table_id' => 'Restaurant table',

        ],
    ],

    'restaurant-table-reservation' => [
        'title' => 'Restaurant Table Reservations',

        'actions' => [
            'index' => 'Restaurant Table Reservations',
            'create' => 'New Restaurant Table Reservation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'restaurant-table-reservation' => [
        'title' => 'Restaurant Table Reservations',

        'actions' => [
            'index' => 'Restaurant Table Reservations',
            'create' => 'New Restaurant Table Reservation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'reservation_date' => 'Reservation date',
            'reservation_start_time' => 'Reservation start time',
            'reservation_end_time' => 'Reservation end time',
            'created_by' => 'Created by',
            'restaurant_table_id' => 'Restaurant table',

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
