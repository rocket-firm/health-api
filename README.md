RocketHealth API
============================

Monitoring your websites' health, free disk space and so on.

> In development

## Installation

### Database

Copy default db config by running following command from project root:
```bash
$ cp config/.db.php config/db.php
```

Update newly copied config by actual db connection info. Don't forget to create `db_health_tests` db for tests.

### Migrations

Run projects' migrations with
```bash
$ php yii migrate
```

### Tests migrations

If you created `db_health_tests` database for testing environment run the following command
```bash
$ php tests/bin/yii migrate
```

### Using PageSpeed API

Obtain PageSpeed API key from here [Google Developer Console](https://console.developers.google.com/apis/library/pagespeedonline.googleapis.com/)
and copy `.params-local.php` file to `params-local.php` inside your `config` folder.

```bash
$ cp config/.params-local.php config/params-local.php
```

## Testing

Run tests by
```bash
$ ./vendor/vin/codecept run
```