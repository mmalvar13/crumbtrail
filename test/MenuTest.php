<?php

namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Menu, Profile, Company};
// TODO Other classes?

require_once("CrumbTrailTest.php");

require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * PHPUnit test for the Menu Class
 * @see Menu
 * @author Kevin Lee Kirk
 **/

 class MenuTest extends CrumbTrailTest {
 	// Set the protected parameter values.

 	/**
 	 * menuCost
 	 * @var float $VALID_MENUCOST
 	 **/
 	protected $VALID_MENUCOST = 1.99;
 	/**
 	 * updated menuCost
 	 * @var float $VALID_MENUCOST2
 	 **/
 	protected $VALID_MENUCOST2 = 2.99;

    /**
	 * menuDescription
	 * @var string $VALID_MENUDESCRIPTION
	 **/
	protected $VALID_MENUDESCRIPTION = "A huge bowl of four kinds of melted artisanal cheese. Sure to fill your belly and clog your arteries!";
	/**
	 * updated menuDescription
	 * @var string $VALID_MENUDESCRIPTION2
	 **/
	protected $VALID_MENUDESCRIPTION2 = "Tasty organic black beans with green chili, brown rice and a huge slab of free-range bacon. Our pigs are vegan and lovin' it!";

    /**
	 * menuItem
	 * @var string $VALID_MENUITEM
	 **/
	protected $VALID_MENUITEM = "Cheese bowl";
	/**
	 * updated menuItem
	 * @var string $VALID_MENUITEM2
	 **/
	protected $VALID_MENUITEM2 = "Beans and rice";


    // TODO: Create dependent objects before running each test?


    /**
	 * Test inserting a valid Menu into the mySQL database,
	 * then check if the data in the database is equal to the
	 * data that you put into the database.
	 **/
	public function testInsertValidMenu() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("menu");

		// Create a new Menu and insert into mySQL.
		$menu = new Menu(null, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM;
		$menu->insert($this->getPDO());

		// Get the data from mySQL and check that the fields match our expectations.
		$pdoMenu = Menu::getMenuByMenuId($this->getPDO(), $menu->getMenuId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("menu"));

		$this->assertEquals($pdoMenu->getMenuCost(), $this->VALID_MENUCOST);

        $this->assertEquals($pdoMenu->getMenuDescription(), $this->VALID_MENUDESCRIPTION);

        $this->assertEquals($pdoMenu->getMenuItem(), $this->VALID_MENUITEM);
	}


    /**
	 * Test inserting a Menu that already exists.
	 * Create a Menu with a non-null menu id and watch it fail.
	 * @expectedException \PDOException
	 * @expectedException \TypeError if $pdo is not a PDO connection object
	 **/
	public function testInsertInvalidMenu() {
		$menu = new Menu(CrumbTrailTest::INVALID_KEY, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
		$menu->insert($this->getPDO());
	}


    /**
	 * Test inserting a Menu, and then updating it.
	 **/
	public function testUpdateValidMenu() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("menu");

		// Create a new Menu and insert to into mySQL.
		$menu = new menu(null, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
		$menu->insert($this->getPDO());

		// Edit the Menu and update it in mySQL.
		$menu->setMenuCost($this->VALID_MENUCOST2);
        $menu->setMenuDescription($this->VALID_MENUDESCRIPTION2);
        $menu->setMenuItem($this->VALID_MENUITEM2);
		$menu->update($this->getPDO());

        // Get the data from mySQL and check that the fields match our expectations.
        $pdoMenu = Menu::getMenuByMenuId($this->getPDO(), $menu->getMenuId());

        $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("menu"));

        $this->assertEquals($pdoMenu->getMenuCost(), $this->VALID_MENUCOST);

        $this->assertEquals($pdoMenu->getMenuDescription(), $this->VALID_MENUDESCRIPTION);

        $this->assertEquals($pdoMenu->getMenuItem(), $this->VALID_MENUITEM);
	}


    /**
	 * Test updating a Menu that does not exist.
	 *
	 * Create a Menu and try to update it (without actually updating it) and watch it fail.
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidMenu() {
		$menu = new Menu(null,  $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
		$menu->update($this->getPDO());
	}


    /**
	 * Test creating a Menu and then deleting it.
	 **/
	public function testDeleteValidMenu() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("menu");

		// Create a new Menu object and insert to into mySQL.
		$menu = new Menu(null,  $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
		$menu->insert($this->getPDO());

		// Delete the Menu object from mySQL.
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("menu"));
		$menu->delete($this->getPDO());

		// Get the data from mySQL and enforce the Menu object does not exist.
		$pdoMenu = Menu::getMenuByMenuId($this->getPDO(), $menu->getMenuId());
		$this->assertNull($pdoMenu);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("menu"));
	}


    /**
     * Test deleting a Menu object that does not exist.
     *
     * @expectedException \PDOException
     **/
    public function testDeleteInvalidMenu() {
        // Create a Menu, and try to delete it, without actually inserting it.
        $menu = new Menu(null, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
        $menu->delete($this->getPDO());
    }


    /**
	 * Test getting a Menu by menuDescription.
	 **/

     // TODO This is not done yet. ***********

	public function testGetValidMenuByMenuDescription() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("menu");

		// Create a new Menu and insert to into mySQL.
		$menu = new Menu(null, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_ITEM);
		$menu->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations.
		$results = Menu::getMenuByMenuDescription($this->getPDO(), $menu->getMenuDescription());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("menu"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Menu", $results);
        // TODO Change namespace?

		// Grab the result from the array and validate it.
		$pdoMenu = $results[0];

		$this->assertEquals($pdoMenu->getMenuCost(), $this->VALID_MENUCOST);
		$this->assertEquals($pdoMenu->getMenuDescription(), $this->VALID_MENUDESCRIPTION);
        $this->assertEquals($pdoMenu->getMenuItem(), $this->VALID_MENUITEM);
	}


        /**
        * Test getting a invalid Menu by menuItem
        **/
        // TODO Which other invalid things do I need to test?

    public function testGetInvalidMenuByMenuItem() {
        // Grab a menu by searching for a menu that does not exist.
        $menu = Menu::getMenuByMenuItem($this->getPDO(), "This is not a valid menuItem");
        $this->assertCount(0, $menu);
    }



    /**
	 * Test getting all Menus
	 **/
	public function testGetAllValidMenus() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("menu");

		// Create a new Menu and insert to into mySQL.
		$menu = new Menu(null, $this->VALID_MENUCOST, $this->VALID_MENUDESCRIPTION, $this->VALID_MENUITEM);
		$menu->insert($this->getPDO());

		// Get the data from mySQL and check that fields match our expectations.
		$results = Menu::getAllMenus($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("menu"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Menu", $results);
        // TODO Change namespace?

		// Get the result from the array, and validate it.
		$pdoMenu = $results[0];

        $this->assertEquals($pdoMenu->getMenuCost(), $this->VALID_MENUCOST);

        $this->assertEquals($pdoMenu->getMenuDescription(), $this->VALID_MENUDESCRIPTION);

        $this->assertEquals($pdoMenu->getMenuItem(), $this->VALID_MENUITEM);
	}

}
