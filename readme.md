# "Not Safe For Work"-Bagde #

Plugin for [Saito-Forum][saito]. Set and show NSFW-badge on postings.

[saito]: https://github.com/Schlaefer/Saito

## Install ##

Either clone/copy the files in this directory into `app/Plugin/NsfwBadge` or using composer:

```json
{
    "require": {
        "schlaefer/saito-nsfwbadge": "*"
    }
}
```

Add new database-fields:

```mysql
ALTER TABLE `entries` ADD `nsfw` TINYINT(1)  NULL  DEFAULT NULL;
```

Empty the cache in the admin panel to register the DB-changes.

Add to `saito_config.php`:

```php
CakePlugin::load('NsfwBadge', ['bootstrap' => true]);
```

## Uninstall ##

Remove database-fields:

```mysql
ALTER TABLE `entries` DROP `nsfw`;
```

Empty the cache in the admin panel to register the DB-changes.
