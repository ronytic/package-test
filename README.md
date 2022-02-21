# Processmaker Package Test
This package provides the necessary base code to start the developing a package in ProcessMaker 4.

## Development
If you need to create a new ProcessMaker package run the following commands:

```
git clone https://github.com/ProcessMaker/package-test.git
cd package-test
php rename-project.php package-test
composer install
npm install
npm run dev
```

## Installation
* Use `composer require processmaker/package-test` to install the package.
* Use `php artisan package-test:install` to install generate the dependencies.

## Navigation and testing
* Navigate to administration tab in your ProcessMaker 4
* Select `Skeleton Package` from the administrative sidebar

## Uninstall
* Use `php artisan package-test:uninstall` to uninstall the package
* Use `composer remove processmaker/package-test` to remove the package completely
