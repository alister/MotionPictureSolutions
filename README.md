# Motion Picture Solutions coding test
## CategoryTree-PHP-task

Alister Bulman
* alister@abulman.co.uk
* https://github.com/alister
* https://stackoverflow.com/users/6216/alister-bulman
* Blogs:
  * https://www.phpscaling.com/
  * https://alister.github.io/

----

Written with PHP 8.3 (should be ok with anything above PHP 8.0 at least).

To run tests:
```sh
# Create the required 'autoload.php' file & install PHPUnit (v11, released 2024-02-02)
composer install

# Run tests
./vendor/bin/phpunit --testdox

# can also run the original test file:
php -f tests/test.php
```

Individual CategoryItem objects have the master copy of the category-name, an object reference to the parent (if it exists) and the names of child-categories.

Since I am storing all the individual CategoryItem's in an array by name (to enable an O(1) search for pre-existing categories), I also use that for some lookups (and also in the children/subCategories in a CategoryItem object itself).

If there was going to be a large number of categories, this may not be sufficient, but I don't complicate code unless it is actually needed.
