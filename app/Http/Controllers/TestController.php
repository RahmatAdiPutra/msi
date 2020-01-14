<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $this->seedSetting();
        return $this->seedUser();
    }

    public function seedSetting()
    {
        $tables = [
            'app' => [
                'models' => [
                    'application' => [
                        'connection' => 'mysql',
                        'table' => 'applications',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
                        'columns' => [
                            'id',
                            'name',
                            'alias',
                            'hostname',
                            'ip',
                            'port',
                            'url',
                            'logo',
                            'token',
                            'version',
                            'description',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'name',
                            'alias',
                            'hostname',
                            'ip',
                            'port',
                            'url',
                            'logo',
                            'token',
                            'version',
                            'description',
                            'updated_by',
                        ],
                        'rules' => [
                            'name' => ['required'],
                            'alias' => [],
                            'hostname' => ['required'],
                            'ip' => ['required'],
                            'port' => ['required'],
                            'url' => ['required'],
                            'logo' => ['required'],
                            'token' => [],
                            'version' => [],
                            'description' => [],
                            'updated_by' => [],
                        ],
                    ],
                    'company' => [
                        'connection' => 'mysql',
                        'table' => 'companies',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
                        'columns' => [
                            'id',
                            'name',
                            'alias',
                            'website',
                            'email',
                            'phone_number',
                            'fax',
                            'logo',
                            'country',
                            'city',
                            'address',
                            'postal_code',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'name',
                            'alias',
                            'website',
                            'email',
                            'phone_number',
                            'fax',
                            'logo',
                            'country',
                            'city',
                            'address',
                            'postal_code',
                            'updated_by',
                        ],
                        'rules' => [
                            'name' => ['required'],
                            'alias' => [],
                            'website' => [],
                            'email' => ['required'],
                            'phone_number' => ['required'],
                            'fax' => [],
                            'logo' => ['required'],
                            'country' => ['required'],
                            'city' => ['required'],
                            'address' => ['required'],
                            'postal_code' => ['required'],
                            'updated_by' => [],
                        ],
                    ],
                    'department' => [
                        'connection' => 'mysql',
                        'table' => 'departments',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
                        'columns' => [
                            'id',
                            'company_id',
                            'name',
                            'alias',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'company_id',
                            'name',
                            'alias',
                            'updated_by',
                        ],
                        'rules' => [
                            'company_id' => ['required'],
                            'name' => ['required'],
                            'alias' => [],
                            'updated_by' => [],
                        ],
                    ],
                    'permission' => [
                        'connection' => 'mysql',
                        'table' => 'permissions',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
                        'columns' => [
                            'id',
                            'application_id',
                            'name',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'application_id',
                            'name',
                            'updated_by',
                        ],
                        'rules' => [
                            'application_id' => ['required'],
                            'name' => ['required'],
                            'updated_by' => [],
                        ],
                    ],
                    'role' => [
                        'connection' => 'mysql',
                        'table' => 'roles',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
                        'columns' => [
                            'id',
                            'company_id',
                            'department_id',
                            'name',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'company_id',
                            'department_id',
                            'name',
                            'updated_by',
                        ],
                        'rules' => [
                            'company_id' => ['required'],
                            'department_id' => ['required'],
                            'name' => ['required'],
                            'updated_by' => [],
                        ],
                    ],
                    'user' => [
                        'connection' => 'mysql',
                        'table' => 'users',
                        'primaryKey' => 'id',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [
                            'password',
                            'remember_token',
                        ],
                        'casts' => [
                            'email_verified_at' => 'datetime',
                            'online' => 'boolean',
                            'status' => 'boolean',
                        ],
                        'columns' => [
                            'id',
                            'identity_card',
                            'name',
                            'gender',
                            'birthday',
                            'religion',
                            'photo',
                            'country',
                            'city',
                            'address',
                            'postal_code',
                            'phone_number',
                            'email',
                            'email_verified_at',
                            'token',
                            'password',
                            'remember_token',
                            'online',
                            'status',
                            'updated_by',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'fillable' => [
                            'identity_card',
                            'name',
                            'gender',
                            'birthday',
                            'religion',
                            'photo',
                            'country',
                            'city',
                            'address',
                            'postal_code',
                            'phone_number',
                            'email',
                            'token',
                            'password',
                            'updated_by',
                        ],
                        'rules' => [
                            'identity_card' => [],
                            'name' => ['required'],
                            'gender' => [],
                            'birthday' => [],
                            'religion' => [],
                            'photo' => [],
                            'country' => [],
                            'city' => [],
                            'address' => [],
                            'postal_code' => [],
                            'phone_number' => [],
                            'email' => ['required'],
                            'token' => [],
                            'password' => [],
                            'updated_by' => [],
                        ],
                    ],
                ],
            ],
        ];

        Setting::set('tables', $tables);
    }

    protected function seedUser($totalRow = 1)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $totalRow; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            User::create([
                'identity_card' => $faker->uuid,
                'name' => $faker->name($gender),
                'gender' => $gender,
                'birthday' => $faker->date('Y-m-d'),
                'religion' => $faker->randomElement(Setting::get('religion')),
                'city' => $faker->city,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->randomNumber.$faker->freeEmail,
                'password' => $faker->sha256,
                'status' => $faker->randomElement([0, 1])
            ]);
        }

        return User::all();

        return 'Seed faker employee';
    }
}
