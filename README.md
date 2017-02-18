# Sanitize Database #

Sanitize a production database when using the Pantheon workflows to clone that database to another environment.

Note that with the current `webphp` type operations (currently the only option for Pantheon), your timeout is limited to 120 seconds, so long-running operations should be avoided for now. 


## Instructions ##

1. Require this Quicksilver module using composer (`composer require rvtraveller/qs-db-sanitization`).
2. Add a Quicksilver operation to your `pantheon.yml` to fire the script before a clone database, using the example.pantheon.yml file for reference.  *Note:* you must set up your project's `composer.json` file to move projects of type `quicksilver-module` to the appropriate directory in your project.
3. Test a clone database out!

Optionally, you may want to use the `terminus workflows watch` command to get immediate debugging feedback.

## Example composer.json file ##

```
{
  "require": {
    "rvtraveller/qs-db-sanitization": "1.0"
  },
  "extra": {
    "installer-paths": {
      "web/private/scripts/quicksilver/{$name}": ["type:quicksilver-module"]
    }
  }
}
```
