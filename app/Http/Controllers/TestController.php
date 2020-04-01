<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class TestController extends Controller
{
    protected $setting, $var, $setup, $class, $model, $route, $faker;

    public function index(Request $request)
    {
        $this->setting = new Setting();
        $this->faker = \Faker\Factory::create();

        $this->setting();
        $this->getClass();

        return $this->test($request);
        return $this->seed($request);
        return $this->default($request);
    }

    public function getClass()
    {
        $data[] = $this;
        $data[] = $this->class;
        $data[] = class_basename($this);
        $data[] = Str::pluralStudly(class_basename($this));
        $data[] = $this->class ?? Str::snake(Str::pluralStudly(class_basename($this)));
        $data[] = Str::title(Str::before(Str::snake(class_basename($this)), '_'));
        return $data;
    }

    protected function setting()
    {
        // setting for application
        $setup = [
            'app' => [
                'models' => [
                    'application' => [
                        'connection' => 'mysql',
                        'table' => 'applications',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [
                            'app_key',
                        ],
                        'casts' => [],
                        'fillable' => [
                            'name',
                            'alias',
                            'hostname',
                            'ip',
                            'port',
                            'url',
                            'logo',
                            'version',
                            'description',
                            'updated_by',
                        ],
                        'rules' => [
                            'name' => ['required'],
                            'alias' => ['unique:applications'],
                            'hostname' => ['required', 'unique:applications'],
                            'ip' => ['required', 'unique:applications'],
                            'port' => ['required'],
                            'url' => ['required', 'unique:applications'],
                            'logo' => ['required'],
                            'version' => ['required'],
                            'description' => [],
                            'updated_by' => [],
                        ],
                        'customKey' => true,
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                        'logo' => 'http://lorempixel.com/640/480/',
                    ],
                    'company' => [
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
                            'email' => ['required', 'email', 'unique:companies'],
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
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                        'logo' => 'http://lorempixel.com/640/480/',
                    ],
                    'department' => [
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
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                    ],
                    'user' => [
                        'connection' => 'mysql',
                        'table' => 'users',
                        'primaryKey' => 'id',
                        'keyType' => 'int',
                        'timestamps' => true,
                        'incrementing' => true,
                        'hidden' => [
                            'token',
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
                            'full_name',
                            'user_name',
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
                            'password',
                            'online',
                            'status',
                            'updated_by',
                        ],
                        'rules' => [
                            'identity_card' => ['unique:users'],
                            'full_name' => ['required'],
                            'user_name' => ['required', 'unique:users'],
                            'gender' => [],
                            'birthday' => [],
                            'religion' => [],
                            'photo' => [],
                            'country' => [],
                            'city' => [],
                            'address' => [],
                            'postal_code' => [],
                            'phone_number' => [],
                            'email' => ['required', 'email', 'unique:users'],
                            'password' => [],
                            'online' => [],
                            'status' => [],
                            'updated_by' => [],
                        ],
                        'customKey' => false,
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                        'photo' => 'http://lorempixel.com/640/480/',
                        'online' => [
                            'offline',
                            'online',
                        ],
                        'status' => [
                            'not active',
                            'active',
                        ],
                    ],
                    'role' => [
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
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                    ],
                    'permission' => [
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
                            'name' => ['required', 'unique:permissions'],
                            'updated_by' => [],
                        ],
                        'customKey' => false,
                        'searchColumn' => 'name',
                        'searchOrder' => 'updated_at',
                    ],
                ],
            ],
            'routes' => [
                'api' => [
                    '*',
                    'data',
                    'relation',
                    'create',
                    'read',
                    'update',
                    'delete',
                ],
            ],
            'namespace' => [
                'model' => 'App\Models\\'
            ],
            'search' => [
                'clause' => [
                    'where',
                    'whereIn',
                    'whereNotIn',
                ],
                'direction' => [
                    'asc',
                    'desc',
                ],
                'default' => [
                    'clause' => 'where',
                    'direction' => 'desc',
                ],
            ],
            'message' => [
                'Succesfully',
                'Not found',
                'Data has been created',
                'Data has been updated',
                'Data has been deleted',
            ],
        ];
        // setting for dummy
        $var = [
            'application' => [
                [
                    'name' => 'Application Management System',
                    'alias' => 'ams',
                    'model' => [
                        'application',
                        'company',
                        'department',
                        'permission',
                        'role',
                        'user',
                    ],
                ],
            ],
            'company' => [
                [
                    'name' => 'Mitra Sahabat Informatika',
                    'alias' => 'msi',
                ],
            ],
            'gender' => [
                'Male',
                'Female',
            ],
            'religion' => [
                'Islam',
                'Kristen',
                'Hindu',
                'Budha',
                'Konghucu',
            ],
        ];

        Setting::set('setup', $setup);
        Setting::set('var', $var);

        $this->setup = $this->setting->get('setup');
        $this->var = $this->setting->get('var');
        $this->model = collect(data_get($this->setup, 'app.models'))->keys();
        $this->route = collect(data_get($this->setup, 'routes'));
    }

    protected function default($request)
    {
        $request->all();
        $userId = User::pluck('id');
        $applicationId = Application::whereIn('name', collect($this->var['application'])->pluck('name'))->pluck('id');
        $companyId = Company::whereIn('name', collect($this->var['company'])->pluck('name'))->pluck('id');
        $roleId = Role::whereIn('company_id', $companyId)->pluck('id');
        $permissionId = Permission::whereIn('application_id', $applicationId)->pluck('id');

        $syncRole = [];
        $randId = $this->faker->randomElement($roleId);
        $role = Role::find($randId);
        foreach ($permissionId as $id) {
            $permission = Permission::find($id);
            $syncRole[] = [
                'permission_id' => $permission->id,
                'application_id' => $permission->application_id,
                'department_id' => $role->department_id,
                'company_id' => $role->company_id,
            ];
        }
        $role->permissions()->sync($syncRole);

        $syncUser = [];
        $randId = $this->faker->randomElement($userId);
        $user = User::find($randId);
        foreach ($roleId as $id) {
            $role = Role::find($id);
            $syncUser[] = [
                'role_id' => $role->id,
                'application_id' => $this->faker->randomElement($applicationId),
                'department_id' => $role->department_id,
                'company_id' => $role->company_id,
            ];
        }
        $user->roles()->sync($syncUser);

        dd($userId, $applicationId, $companyId, $roleId, $permissionId);
    }

    protected function test($request)
    {
        $data = [];
        $data['request'] = $request->all();
        $data['date-time'] = Carbon::now()->timestamp;
        $data['ip'] = $request->ip();
        $data['env'] = env('APP_KEY');

        // $test = collect(User::with('roles')->find(10)->get())->pluck('roles');
        // $test = collect($test)->flatten()->pluck('permissions')->flatten();
        // $id = 87;
        // $test = User::with(['roles' => function($query) use ($id){
        //     $query->where('id', $id);
        // }])->find(10);
        // return $test;

        foreach ($this->model as $model) {
            // $singular = Str::singular($model);
            // $plural = Str::plural($model);
            // $data['singular'][] = $singular;
            // $data['plural'][] = $plural;
            $className = "App\Models\\".ucwords($model);
            // $data['models'][$model] = Schema::getColumnListing($plural);
            $data['data'][$model] = $className::latest()->first();
        }

        return $data;
    }

    protected function seed($request)
    {
        if ($request->seed) {
            try {
                if ($request->row) {
                    return $this->{'seed' . ucwords($request->seed)}($request->row);
                } else {
                    return $this->{'seed' . ucwords($request->seed)}();
                }
            } catch (\Exception $e) {
                return $this->responseSuccess(['message' => $e->getMessage()]);
            }
        }

        return $this->seedAll($request);
    }

    protected function seedAll($request)
    {
        //test?seed=user&row=50
        //test?seed=application&row=5
        //test?seed=company&row=5
        //test?seed=department&row=5
        //test?seed=permission&row=5
        //test?seed=role&row=5
        //test?seed=rolepermission&row=5
        //test?seed=userrole&row=5

        $table = [
            'user' => 50,
            'application' => 5,
            'company' => 5,
            'department' => 5,
            'permission' => 5,
            'role' => 5,
            // 'rolepermission' => 5,
            // 'userrole' => 5,
        ];

        foreach ($table as $key => $value) {
            $request->seed = $key;
            $request->row = $value;
            $data[$key] = $this->seed($request);
        }

        return $data;
    }

    protected function seedUser($totalRow = 10)
    {
        for ($i = 0; $i < $totalRow; $i++) {
            $gender = $this->faker->randomElement($this->var['gender']);
            User::create([
                'identity_card' => $this->faker->isbn13,
                'full_name' => $this->faker->name($gender),
                'user_name' => $this->faker->userName,
                'gender' => $gender,
                'birthday' => $this->faker->date('Y-m-d'),
                'religion' => $this->faker->randomElement($this->var['religion']),
                'photo' => null,
                'country' => $this->faker->country,
                'city' => $this->faker->city,
                'address' => $this->faker->address,
                'postal_code' => $this->faker->postcode,
                'phone_number' => $this->faker->phoneNumber,
                'email' => $this->faker->randomNumber.$this->faker->freeEmail,
                'password' => $this->faker->sha256,
                'online' => $this->faker->randomElement([0, 1]),
                'status' => $this->faker->randomElement([0, 1]),
            ]);
        }

        return 'Seed faker user';
    }

    protected function seedApplication($totalRow = 10)
    {
        $userId = User::pluck('id');
        $application = Application::first();
        if (empty($application)) {
            foreach ($this->var['application'] as $app) {
                $version = 'v'.$this->faker->numberBetween(0, 10).'.'.$this->faker->numberBetween(0, 10).'.'.$this->faker->numberBetween(0, 10);
                Application::create([
                    'name' => $app['name'],
                    'alias' => $app['alias'],
                    'hostname' => $this->faker->domainName,
                    'ip' => $this->faker->ipv4,
                    'port' => $this->faker->numberBetween(0, 65535),
                    'url' => $this->faker->url,
                    'logo' => null,
                    'version' => $version,
                    'description' => $this->faker->text(100),
                    'updated_by' => $this->faker->randomElement($userId),
                ]);
            }
        }
        for ($i = 0; $i < $totalRow; $i++) {
            $version = 'v'.$this->faker->numberBetween(0, 10).'.'.$this->faker->numberBetween(0, 10).'.'.$this->faker->numberBetween(0, 10);
            Application::create([
                'name' => $this->faker->word,
                'alias' => $this->faker->domainWord,
                'hostname' => $this->faker->domainName,
                'ip' => $this->faker->ipv4,
                'port' => $this->faker->numberBetween(0, 65535),
                'url' => $this->faker->url,
                'logo' => null,
                'version' => $version,
                'description' => $this->faker->text(100),
                'updated_by' => $this->faker->randomElement($userId),
            ]);
        }
        return 'Seed faker application';
    }

    protected function seedCompany($totalRow = 10)
    {
        $userId = User::pluck('id');
        $company = Company::first();
        if (empty($company)) {
            foreach ($this->var['company'] as $com) {
                Company::create([
                    'name' => $com['name'],
                    'alias' => $com['alias'],
                    'website' => $this->faker->domainName,
                    'email' => $this->faker->randomNumber.$this->faker->freeEmail,
                    'phone_number' => $this->faker->phoneNumber,
                    'fax' => $this->faker->tollFreePhoneNumber,
                    'logo' => null,
                    'country' => $this->faker->country,
                    'city' => $this->faker->city,
                    'address' => $this->faker->address,
                    'postal_code' => $this->faker->postcode,
                    'updated_by' => $this->faker->randomElement($userId),
                ]);
            }
        }
        for ($i = 0; $i < $totalRow; $i++) {
            Company::create([
                'name' => $this->faker->company,
                'alias' => $this->faker->companySuffix,
                'website' => $this->faker->domainName,
                'email' => $this->faker->randomNumber.$this->faker->freeEmail,
                'phone_number' => $this->faker->phoneNumber,
                'fax' => $this->faker->tollFreePhoneNumber,
                'logo' => null,
                'country' => $this->faker->country,
                'city' => $this->faker->city,
                'address' => $this->faker->address,
                'postal_code' => $this->faker->postcode,
                'updated_by' => $this->faker->randomElement($userId),
            ]);
        }
        return 'Seed faker company';
    }

    protected function seedDepartment($totalRow = 10)
    {
        $userId = User::pluck('id');
        $companyId = Company::pluck('id');
        $department = Department::first();
        if (empty($department)) {
            foreach ($companyId as $id) {
                $number = $this->faker->numberBetween(1, $totalRow);
                for ($i = 0; $i < $number; $i++) {
                    Department::create([
                        'company_id' => $id,
                        'name' => $this->faker->word,
                        'alias' => $this->faker->word,
                        'updated_by' => $this->faker->randomElement($userId),
                    ]);
                }
            }
        }
        for ($i = 0; $i < $totalRow; $i++) {
            Department::create([
                'company_id' => $this->faker->randomElement($companyId),
                'name' => $this->faker->word,
                'alias' => $this->faker->word,
                'updated_by' => $this->faker->randomElement($userId),
            ]);
        }
        return 'Seed faker department';
    }

    protected function seedPermission($totalRow = 10)
    {
        $userId = User::pluck('id');
        $applicationId = Application::whereNotIn('name', collect($this->var['application'])->pluck('name'))->pluck('id');
        $permission = Permission::first();
        if (empty($permission)) {
            foreach ($this->var['application'] as $app) {
                $application = Application::where('name', $app['name'])->first();
                foreach ($app['model'] as $model) {
                    foreach ($this->route['api'] as $route) {
                        Permission::create([
                            'application_id' => $application->id,
                            'name' => $application->alias.'.'.$model.'.'.$route,
                            'updated_by' => $this->faker->randomElement($userId),
                        ]);
                    }
                }
            }
            foreach ($applicationId as $id) {
                $application = Application::find($id);
                $number = $this->faker->numberBetween(1, $totalRow);
                for ($i = 0; $i < $number; $i++) {
                    foreach ($this->route['api'] as $route) {
                        Permission::create([
                            'application_id' => $application->id,
                            'name' => $application->alias.'.'.$this->faker->word.$i.'.'.$route,
                            'updated_by' => $this->faker->randomElement($userId),
                        ]);
                    }
                }
            }
        }
        for ($i = 0; $i < $totalRow; $i++) {
            $randId = $this->faker->randomElement($applicationId);
            $application = Application::find($randId);
            foreach ($this->route['api'] as $route) {
                Permission::create([
                    'application_id' => $application->id,
                    'name' => $application->alias.'.'.$this->faker->word.$i.'.'.$route,
                    'updated_by' => $this->faker->randomElement($userId),
                ]);
            }
        }
        return 'Seed faker permission';
    }

    protected function seedRole($totalRow = 10)
    {
        $userId = User::pluck('id');
        $role = Role::first();
        if (empty($role)) {
            foreach (Department::pluck('id') as $id) {
                $department = Department::find($id);
                $number = $this->faker->numberBetween(1, $totalRow);
                for ($i = 0; $i < $number; $i++) {
                    Role::create([
                        'department_id' => $department->id,
                        'company_id' => $department->company_id,
                        'name' => $this->faker->jobTitle,
                        'updated_by' => $this->faker->randomElement($userId),
                    ]);
                }
            }
        }
        for ($i = 0; $i < $totalRow; $i++) {
            $department = Department::inRandomOrder()->first();
            Role::create([
                'department_id' => $department->id,
                'company_id' => $department->company_id,
                'name' => $this->faker->jobTitle,
                'updated_by' => $this->faker->randomElement($userId),
            ]);
        }
        return 'Seed faker role';
    }

    protected function seedRolepermission($totalRow = 10)
    {
        $permissionId = Permission::pluck('id');
        $roleId = Role::pluck('id');
        for ($i = 0; $i < $totalRow; $i++) {
            $data = [];
            $randId = $this->faker->randomElement($roleId);
            $role = Role::find($randId);
            $number = $this->faker->numberBetween(1, $totalRow);
            for ($i = 0; $i < $number; $i++) {
                $randId = $this->faker->randomElement($permissionId);
                $permission = Permission::find($randId);
                $data[] = [
                    'permission_id' => $permission->id,
                    'application_id' => $permission->application_id,
                    'department_id' => $role->department_id,
                    'company_id' => $role->company_id,
                ];
            }
            $role->permissions()->sync($data);
        }
        return 'Seed faker role permissions';
    }

    protected function seedUserrole($totalRow = 10)
    {
        $userId = User::pluck('id');
        $applicationId = Application::pluck('id');
        $roleId = Role::pluck('id');
        for ($i = 0; $i < $totalRow; $i++) {
            $data = [];
            $randId = $this->faker->randomElement($userId);
            $user = User::find($randId);
            $number = $this->faker->numberBetween(1, $totalRow);
            for ($i = 0; $i < $number; $i++) {
                $randId = $this->faker->randomElement($roleId);
                $role = Role::find($randId);
                $data[] = [
                    'role_id' => $role->id,
                    'application_id' => $this->faker->randomElement($applicationId),
                    'department_id' => $role->department_id,
                    'company_id' => $role->company_id,
                ];
            }
            $user->roles()->sync($data);
        }
        return 'Seed faker user roles';
    }
}
