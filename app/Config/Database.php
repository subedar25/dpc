<?php namespace Config;

/**
 * Database Configuration
 *
 * @package Config
 */

class Database extends \CodeIgniter\Database\Config
{
	/**
	 * The directory that holds the Migrations
	 * and Seeds directories.
	 *
	 * @var string
	 */
	public $filesPath = APPPATH . 'Database/';

	/**
	 * Lets you choose which connection group to
	 * use if no other is specified.
	 *
	 * @var string
	 */
	public $defaultGroup = 'default';

	/**
	 * The default database connection.
	 *
	 * @var array
	 */
	
	public $default = [
		'DSN'      => '',
		'hostname' => 'db',
		'username' => 'yellow_bdpc_useranana',
		'password' => 'dpc_pass',
		'database' => 'dpc_db',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];


	public $production = [
		'DSN'      => '',
		'hostname' => 'db',
		'username' => 'yellow_bdpc_useranana',
		'password' => 'dpc_pass',
		'database' => 'dpc_db',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];


	/**
	 * This database connection is used when
	 * running PHPUnit database tests.
	 *
	 * @var array
	 */
	public $tests = [
		'DSN'      => '',
		'hostname' => '127.0.0.1',
		'username' => '',
		'password' => '',
		'database' => ':memory:',
		'DBDriver' => 'SQLite3',
		'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Pull DB settings from .env (cannot call env() in property defaults)
		$this->default['hostname'] = env('database.default.hostname', $this->default['hostname']);
		$this->default['username'] = env('database.default.username', $this->default['username']);
		$this->default['password'] = env('database.default.password', $this->default['password']);
		$this->default['database'] = env('database.default.database', $this->default['database']);
		$this->default['DBDriver'] = env('database.default.DBDriver', $this->default['DBDriver']);
		$this->default['port'] = (int) env('database.default.port', $this->default['port']);

		$this->production['hostname'] = env('database.production.hostname', $this->default['hostname']);
		$this->production['username'] = env('database.production.username', $this->default['username']);
		$this->production['password'] = env('database.production.password', $this->default['password']);
		$this->production['database'] = env('database.production.database', $this->default['database']);
		$this->production['DBDriver'] = env('database.production.DBDriver', $this->default['DBDriver']);
		$this->production['port'] = (int) env('database.production.port', $this->default['port']);

		// Ensure that we always set the database group to 'tests' if
		// we are currently running an automated test suite, so that
		// we don't overwrite live data on accident.
		if (ENVIRONMENT === 'testing')
		{
			$this->defaultGroup = 'tests';

			// Under Travis-CI, we can set an ENV var named 'DB_GROUP'
			// so that we can test against multiple databases.
			if ($group = getenv('DB'))
			{
				if (is_file(TESTPATH . 'travis/Database.php'))
				{
					require TESTPATH . 'travis/Database.php';

					if (! empty($dbconfig) && array_key_exists($group, $dbconfig))
					{
						$this->tests = $dbconfig[$group];
					}
				}
			}
		}
		elseif(ENVIRONMENT === 'production')
		{
			$this->defaultGroup = 'production';
		}
	}

	//--------------------------------------------------------------------

}
