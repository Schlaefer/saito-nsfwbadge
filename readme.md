# "Not Safe For Work"-Bagde #

Plugin for [Saito-Forum][saito]. Set and show NSFW-badge on postings.

[saito]: https://github.com/Schlaefer/Saito

## Install ##

Either clone/copy the files in this directory into `app/Plugin/NsfwBadge` or using composer:

```bash
composer require schlaefer/saito-nsfwbadge
```

Add new database-fields:

```sql
ALTER TABLE `entries` ADD `nsfw` TINYINT(1)  NULL  DEFAULT NULL;
```

Empty the cache in the admin panel to register the DB-changes.

```bin
bin/cake plugin load Siezi/SaitoNsfwBadge
```

[See CakePHP plugin documentation for alternative methods](https://book.cakephp.org/3.0/en/plugins.html#loading-a-plugin).

## Uninstall ##

Remove database-fields:

```sql
ALTER TABLE `entries` DROP `nsfw`;
```

Empty the cache in the admin panel to register the DB-changes.
