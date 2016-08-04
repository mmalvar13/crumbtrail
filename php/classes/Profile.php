<?php

/**
 * Created by PhpStorm.
 * User: crumbtrail
 * Date: 8/4/16
 * Time: 2:55 PM
 */
class Profile {



<?php
// This is the OOP for the Author entity.


class Profile {
	// The class Profile has 8 attributes: profileId and profileName

	private $authorId;
	/** This is the id number for an author.  This is the primary key.
	 * @var int $authorId
	 **/

	private $authorName;
	/** This is the name of an author.
	 * @var string $authorName
	 **/

	/**
	 * Constructor for this Author
	 * @param int|null $newAuthorId id of this Author
	 * @param string $newAuthorName name of this Author
	 * @throws \InvalidArgumentException if the data types are not valide
	 * @throws \RangeException if the data values are too large
	 * @throws \TypeError if the data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newAuthorId = null, string $newAuthorName) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorName($newAuthorName);

		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));

		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));

		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));

		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/** Accessor method for author Id
	 *
	 * @return int|null value of author Id
	 **/
	public function getAuthorId() {
		return ($this->authorId);
	}

	/** Mutator method for author Id
	 *
	 * @param int|null $newAuthorId This is the new value of Author Id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not an integer
	 **/

	public function setAuthorId(int $newAuthorId = null) {
		// Base case: if the author Id is null, then this is a new author,
		// with no mySQL-assigned id yet.  This is weird because authorId
		// is the primary key.
		if($newAuthorId === null) {
			$this->tweetId = null;
			return;
		}

		// verify that the author id is positive
		if($newAuthorId <= 0) {
			throw(new \RangeException("The author id is not positive"));
		}

		// Convert (??) and store the author id
		$this->authorId = $newAuthorId;
	}

	/**
	 * Accessor method for author name
	 *
	 * @return string value of author name
	 **/
	public function getAuthorName() {
		return ($this->authorName);
	}

	/**
	 * Mutator method for author name
	 *
	 * @param string $newAuthorName new value of author name
	 * @throws \InvalidArgumentException if $newAuthorName is not a string or is insecure
	 * @throws \RangeException if $newAuthorName is too long, > 128 characters
	 * @throws \TypeError if $newAuthorName is not a string
	 **/
	public function setAuthorName(string $newAuthorName) {
		// Verify that the author name is secure
		$newAuthorName = trim($newAuthorName);
		$newAuthorName = filter_var($newAuthorName);
		if(empty($newAuthorName) === true) {
			throw(new \InvalidArgumentException("Author name is empty or insecure"));
		}

		// Verify that the author name will fit into the database
		if(strlen($newAuthorName) > 128) {
			throw(new \RangeException("author name is too long"));
		}

		// Store the author name
		$this->authorName = $newAuthorName;
	}
}

?>



}