# PhpCleanRequest 1.0
The purpose of this class is to clear all the input parameters in an HTTP request by avoiding the passage of SQL Injection made by bad intentioned people.

Recommended for applications where old functions are still used such as `` `mysql_query``` where there is no automatic processing of sql injection

- Remove SQL injection
- Add caracter scape

***Use PhpCleanRequest***
```php
<?php
PhpCleanRequest::clean();

echo $_GET['id'];

/*
* Result:
* 999999.9\' union all
*/
?>
```

***Not use PhpCleanRequest***
```php
<?php
echo $_GET['id'];

/*
* Result:
* 999999.9' union all select
*/
?>
```
