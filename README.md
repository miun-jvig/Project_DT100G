# -- Projekt_DT100G --

A project done in the course Webbprogrammering (DT100G) in Mittuniversitetet, Sundsvall. The project is a soft-reserve website for World of Warcraft, utilizing Blizzards API to get all items from the expansion The Burning Crusade.

Website can be reached on https://studenter.miun.se/~jovi1802/DT100G/Projekt/createID.php.

**API**

The API is based on Justin Stolpe's Youtube-video https://www.youtube.com/watch?v=ABmyXZoq_9Y, and is using a generated key according to Blizzards guide https://develop.battle.net/documentation/guides/using-oauth.

To use:
- Get your own access-token from Blizzard from https://develop.battle.net/documentation/guides/using-oauth, update files
- Update database, database username, database password to your own in files - should create a database class to do this, but currently you have to update several files
