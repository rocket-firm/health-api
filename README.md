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

## Testing

Run tests by
```bash
$ ./vendor/vin/codecept run
```