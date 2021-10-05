<?php

function user($user) //for single user data or (first)
{
    return $user = [
        'id' => $user->id,
        'name' => $user->name,
        'subjects' => $user->subjects->map(function ($item, $key) {
            return [
                'name_en' => $item['name_en']
            ];
        }),
    ];
}

function userdata($user)
{

    return $user = $user->map(function ($item, $key) {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'subjects' => $item->subjects->map(function ($item, $key) {
                return [
                    'name_en' => $item['name_en']
                ];
            }),
        ];
    });
}
