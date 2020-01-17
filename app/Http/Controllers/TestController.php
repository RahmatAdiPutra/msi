<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class TestController extends Controller
{
    public function index(Request $request)
    {
        // return Carbon::now()->format('Ymdhms');
        $this->seedSetting();
        return $this->seedUser();
        Schema::getColumnListing('users');
    }

    public function seedSetting()
    {
        $setup = [
            'app' => [
                'models' => [
                    'applications' => [
                        'connection' => 'mysql',
                        'table' => 'applications',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
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
                        'customKey' => false,
                    ],
                    'companies' => [
                        'connection' => 'mysql',
                        'table' => 'companies',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
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
                        'customKey' => false,
                    ],
                    'departments' => [
                        'connection' => 'mysql',
                        'table' => 'departments',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
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
                        'customKey' => false,
                    ],
                    'permissions' => [
                        'connection' => 'mysql',
                        'table' => 'permissions',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
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
                        'customKey' => false,
                    ],
                    'roles' => [
                        'connection' => 'mysql',
                        'table' => 'roles',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [],
                        'casts' => [],
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
                        'customKey' => false,
                    ],
                    'users' => [
                        'connection' => 'mysql',
                        'table' => 'users',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
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
                        'customKey' => false,
                        'online' => [
                            'offline',
                            'online',
                        ],
                        'status' => [
                            'not active',
                            'active',
                        ],
                    ],
                ],
            ],
        ];

        Setting::set('setup', $setup);
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

        return User::latest()->first();

        return 'Seed faker employee';
    }
}
