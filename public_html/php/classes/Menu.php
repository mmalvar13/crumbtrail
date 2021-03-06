<?php

// ??? Change namespaces for the Digital Ocean host ???
namespace Edu\Cnm\CrumbTrail;
require_once("autoload.php");

/**
 * Menu class
 * @author Kevin Lee Kirk <klkirkhome@gmail.com>
 **/
class Menu implements \JsonSerializable {

	/**
	 * Primary key, menuId.
	 * @var int $menuId ;
	 **/
	private $menuId;

	/**
	 * Foreign key, the company this menu item belongs to, menuCompanyId.
	 * @var int $menuCompanyId ;
	 **/
	private $menuCompanyId;

	/**
	 * The cost of this menu item, menuCost.
	 * @var float $menuCost ;
	 **/
	private $menuCost;

	/**
	 * The description of this menu item, menuDescription.
	 * @var string $menuDescription ;
	 **/
	private $menuDescription;

	/**
	 * The name of this menu item, menuItem.
	 * @var string $menuItem ;
	 **/
	private $menuItem;

//-----------------------------------------------------------------
	/**
	 * Constructor for the class Menu.
	 *
	 * @param int|null $newMenuId
	 * @param int $newMenuCompanyId
	 * @param float $newMenuCost
	 * @param string $newMenuDescription
	 * @param string $newMenuItem
	 * @throws \RangeException when the integer is negative
	 * @throws \TypeError When the variable is not the correct data type
	 * @throws \exception when errors need to be called in the code
	 **/

	public function __construct(int $newMenuId = null, int $newMenuCompanyId, float $newMenuCost, string $newMenuDescription, string $newMenuItem) {

		try {
			$this->setMenuId($newMenuId);
			$this->setMenuCompanyId($newMenuCompanyId);
			$this->setMenuCost($newMenuCost);
			$this->setMenuDescription($newMenuDescription);
			$this->setMenuItem($newMenuItem);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException ($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}

//-----------------------------------------------------------------
	/**
	 * Accessor for the menu id
	 *
	 * @return int|null value of menu id
	 **/
	public function getMenuId() {
		return ($this->menuId);
	}

	/**
	 * Mutator method for menuId
	 *
	 * @param int|null $newMenuId new value of menu id
	 * @throws \RangeException if $newMenuId is negative
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public function setMenuId(int $newMenuId = null) {
		//base case: if the menuId is null, this is a new menu without a mySQL assigned id yet.
		if($newMenuId === null) {
			$this->menuId = null;
			return;
		}
		//verify that the menuId is positive
		if($newMenuId <= 0) {
			throw (new \RangeException ("Menu Id is not positive"));
		}
		$this->menuId = $newMenuId;
	}

//-----------------------------------------------------------------
	/**
	 * Accessor for the menu company Id
	 *
	 * @return Int|null value of menu company Id
	 **/
	public function getMenuCompanyId() {
		return ($this->menuCompanyId);
	}

	/**
	 * Mutator method for menu company id
	 *
	 * @param int|null $newMenuCompanyId new value of menu company Id
	 * @throws \RangeException if $newMenuCompanyId is negative
	 * @throws \TypeError
	 **/
	public function setMenuCompanyId(int $newMenuCompanyId) {
		if($newMenuCompanyId <= 0) {
			throw (new \RangeException ("Menu company Id is not positive"));
		}
		$this->menuCompanyId = $newMenuCompanyId;
	}

//-----------------------------------------------------------------
	/**
	 * Accessor for the menu cost
	 *
	 * @return float value of menu cost e.g. $5.99
	 **/
	public function getMenuCost() {
		return ($this->menuCost);
	}

//	/**
//	 * Accessor for the menu cost
//	 *
//	 * @return string value of menu cost e.g. $5.99
//	 **/
//	public function getMenuCost() {
//		return ($this->menuCost);
//	}

	/**
	 * Mutator method for menu cost
	 *
	 * @param float $newMenuCost new value of menu cost
	 * @throws \RangeException if $newMenuCost is negative
	 * @throws \TypeError
	 * ??? Need something for dollar amount formatting ???
	 **/
	public function setMenuCost(float $newMenuCost) {
		if($newMenuCost <= 0) {
			throw (new \RangeException ("Menu cost is not positive"));
		}
		$this->menuCost = $newMenuCost;
	}


//	/**
//	 * Mutator method for menu cost
//	 *
//	 * @param string $newMenuCost new value of menu cost
//	 * @throws \RangeException if $newMenuCost is negative
//	 * @throws \InvalidArgumentException if $newMenuCost is not a string
//	 * @throws \TypeError if $newMenuItem is not a string
//	 * ??? Need something for dollar amount formatting ???
//	 **/
//	public function setMenuCost(string $newMenuCost) {
//		//strip out white space on either end of $newMenuCost
//		$newMenuCost = trim($newMenuCost);
//		//sanitize $newMenuCost
//		$newMenuCost = filter_var($newMenuCost, FILTER_SANITIZE_STRING);
//		//check if $newMenuCost is empty or too long
//		if(strlen($newMenuCost) === 0) {
//			throw(new \RangeException("Menu cost is too short"));
//		}
//		//todo check to see what max characters are in database
//		if(strlen($newMenuCost) > 128) {
//			throw(new \RangeException("Menu cost is too long"));
//		}
//		//assign $newMenuCost to menuCost and store in SQL
//
//		$this->menuCost = $newMenuCost;
//	}


//-----------------------------------------------------------------
	/**
	 * Accessor method for menuDescription.
	 *
	 * @return string $menuDescription e.g. A large bowl of 3 types of cheese.
	 **/
	public function getMenuDescription() {
		return ($this->menuDescription);
	}

	/**
	 * Mutator method for menuDescription.
	 *
	 * @param string $newMenuDescription The new value of menuDescription
	 * @throw \RangeException if $newMenuDescription is empty or too long
	 * @throw \InvalidArgumentException if $newMenuDescription is not a string
	 * @throw \TypeError if $newMenuDescription is not a string
	 **/
	public function setMenuDescription(string $newMenuDescription) {
		// Strip out the white space on either end of the string.
		$newMenuDescription = trim($newMenuDescription);
		// Sanitize $newCompanyName.
		$newMenuDescription = filter_var($newMenuDescription, FILTER_SANITIZE_STRING);
		// If $newMenuDescription is empty or too long then throw an exception.
		// ??? Check the maximum length of this attribute ???
		if(strlen($newMenuDescription) === 0) {
			throw(new \RangeException("Menu description is too short."));
		}
		if(strlen($newMenuDescription) > 512) {
			throw(new \RangeException("Menu description is too long."));
		}
		$this->menuDescription = $newMenuDescription;
	}

//-----------------------------------------------------------------
	/**
	 * Accessor method for menuItem.
	 *
	 * @return string $menuItem e.g. Cheese bowl.
	 **/
	public function getMenuItem() {
		return ($this->menuItem);
	}

	/**
	 * Mutator method for menuItem.
	 *
	 * @param string $newMenuItem The new value of menuItem
	 * @throw \RangeException if $newMenuItem is empty or too long
	 * @throw \InvalidArgumentException if $newMenuItem is not a string
	 * @throw \TypeError if $newMenuItem is not a string
	 **/
	public function setMenuItem(string $newMenuItem) {
		$newMenuItem = trim($newMenuItem);
		$newMenuItem = filter_var($newMenuItem, FILTER_SANITIZE_STRING);
		// If $newMenuItem is empty or too long then throw an exception.
		// ??? Check the maximum length of this attribute ???
		if(strlen($newMenuItem) === 0) {
			throw(new \RangeException("Menu Item is too short."));
		}
		if(strlen($newMenuItem) > 512) {
			throw(new \RangeException("Menu Item is too long."));
		}
		$this->menuItem = $newMenuItem;
	}

//-----------------------------------------------------------------
	/**
	 * Insert this menu object into the mySQL database.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		if($this->menuId !== null) {
			throw(new \PDOException("Not a new menuId"));
		}

		// Create a mySQL query template.
		$query = "INSERT INTO menu(menuCompanyId, menuCost, menuDescription, menuItem) VALUES(:menuCompanyId, :menuCost, :menuDescription, :menuItem)";

		$statement = $pdo->prepare($query);

		$parameters = ["menuCompanyId" => $this->menuCompanyId, "menuCost" => $this->menuCost, "menuDescription" => $this->menuDescription, "menuItem" => $this->menuItem];

		$statement->execute($parameters);

		$this->menuId = intval($pdo->lastInsertId());
	}

//-----------------------------------------------------------------
	/**
	 * Update this menu object in the mySQL database.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		if($this->menuId === null) {
			throw(new \PDOException("Cannot update a menu that does not exist"));
		}

		$query = "UPDATE menu SET menuCompanyId = :menuCompanyId, menuCost = :menuCost, menuDescription = :menuDescription, menuItem = :menuItem WHERE menuId = :menuId";

		$statement = $pdo->prepare($query);

		$parameters = ["menuCompanyId" => $this->menuCompanyId, "menuCost" => $this->menuCost, "menuDescription" => $this->menuDescription, "menuItem" => $this->menuItem, "menuId" => $this->menuId];

		$statement->execute($parameters);
	}

//-----------------------------------------------------------------
	/**
	 * Delete this menu object from the mySQL database.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		if($this->menuId === null) {
			throw(new \PDOException("Cannot delete a menu that does not exist"));
		}

		$query = "DELETE FROM menu WHERE menuId = :menuId";
		$statement = $pdo->prepare($query);
		$parameters = ["menuId" => $this->menuId];
		$statement->execute($parameters);
	}

//-----------------------------------------------------------------
	/**
	 * Get menu by menuId.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $menuId menu id to search for
	 * @return menu|null Menu found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getMenuByMenuId(\PDO $pdo, int $menuId) {
		//sanitize the id before searching for it
		if($menuId <= 0) {
			throw(new \PDOException("menuId is not positive"));
		}
//create query template
		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu WHERE menuId =:menuId";

		$statement = $pdo->prepare($query);
		$parameters = ["menuId" => $menuId];
		$statement->execute($parameters);

		try {
			$menu = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);
			}

		} catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($menu);
	}

//-----------------------------------------------------------------
	/**
	 * Get menu by menuCompanyId.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $menuCompanyId menu company id to search for
	 * @return menu|null Menu found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getMenuByMenuCompanyId(\PDO $pdo, int $menuCompanyId) {
		if($menuCompanyId <= 0) {
			throw(new \PDOException("menuCompanyId is not positive"));
		}

		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu WHERE menuCompanyId =:menuCompanyId";

		$statement = $pdo->prepare($query);
		$parameters = ["menuCompanyId" => $menuCompanyId];
		$statement->execute($parameters);

		try {
			$menu = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);
			}

		} catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($menu);
	}

	/**
	 * Get menu by menuItem, e.g. search for tacos.
	 * ??? Change get company by companyMenuText, in the class Company ???
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $menuItem menu item to search for
	 * @return \SplFixedArray SplFixedArray of menus found, that match the search
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getMenuByMenuItem(\PDO $pdo, string $menuItem) {
		$menuItem = trim($menuItem);
		$menuItem = filter_var($menuItem, FILTER_SANITIZE_STRING);

		if(empty($menuItem) === true) {
			throw(new \PDOException("Menu item is empty"));
		}

		// ??? Check the maximum string length ???
		if(strlen($menuItem) > 512) {
			throw(new \PDOException("Menu item is too long"));
		}

		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu WHERE menuItem =:menuItem";

		$statement = $pdo->prepare($query);
		$parameters = ["menuItem" => $menuItem];
		$statement->execute($parameters);

		try {
			$menu = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);
			}

			// ??? Build an array of all the menus that contain the searched-for menuItem ???
			$menus[$menus->key()] = $menu;
			$menus->next();

		} catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($menus);
	}


//-----------------------------------------------------------------
	/**
	 * Get menu by menuCost.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param float $menuCost menu item to search for
	 * @return \SplFixedArray SplFixedArray of menus found, that match the search
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getMenuByMenuCost(\PDO $pdo, float $menuCost) {
		if(empty($menuCost) === true) {
			throw(new \PDOException("Menu cost is empty"));
		}

		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu WHERE menuCost =:menuCost";

		$statement = $pdo->prepare($query);
		$parameters = ["menuCost" => $menuCost];
		$statement->execute($parameters);

		try {
			$menu = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);
			}

			$menus[$menus->key()] = $menu;
			$menus->next();

		} catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($menus);
	}


//-----------------------------------------------------------------
	/**
	 * Get menu by menuDescription.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $menuDescription menu item to search for
	 * @return \SplFixedArray SplFixedArray of menus found, that match the search
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getMenuByMenuDescription(\PDO $pdo, string $menuDescription) {
		$menuDescription = trim($menuDescription);
		$menuDescription = filter_var($menuDescription, FILTER_SANITIZE_STRING);

		if(empty($menuDescription) === true) {
			throw(new \PDOException("Menu description is empty"));
		}

		// ??? Check the maximum string length ???
		if(strlen($menuDescription) > 512) {
			throw(new \PDOException("Menu description is too long"));
		}

		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu WHERE menuDescription LIKE :menuDescription";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind to the placeholder in the template
		$menuDescription = "%$menuDescription%";
		$parameters = ["menuDescription" => $menuDescription];
		//execute the SQL statement
		$statement->execute($parameters);

		//build an array of menus
		$menus = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) !== false) {
			try {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);

				$menus[$menus->key()] = $menu;
				$menus->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($menus);
	}


	/**
	 * Get all menus.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of menus found, that match the search
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllMenus(\PDO $pdo) {
		//create query template
		$query = "SELECT menuId, menuCompanyId, menuCost, menuDescription, menuItem FROM menu";


		$statement = $pdo->prepare($query);
		$statement->execute();

		$menus = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) !== false) {
			try {
				$menu = new Menu($row["menuId"], $row["menuCompanyId"], $row["menuCost"], $row["menuDescription"], $row["menuItem"]);

				$menus[$menus->key()] = $menu;
				$menus->next();
			} catch
			(\Exception $exception) {
				// If the row couldn't be converted, rethrow it.
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($menus);
	}

	/**
	 * Formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return ($fields);
	}
}

